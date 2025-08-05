<?php

namespace App\Livewire\Definitions;

use Livewire\Component;
use App\Models\Definition;
use App\Models\Type;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class Edit extends Component
{
    use WithFileUploads;

    public $definition;
    public $definition_id;

    // Form fields
    public $name;
    public $code;
    public $barcode;
    public $madin;
    public $type_id;
    public $is_active;

    // Image handling
    public $new_image;
    public $current_image;
    public $remove_image = false;

    public function mount($definition_id)
    {
        $this->definition_id = $definition_id;
        $this->definition = Definition::findOrFail($definition_id);

        $this->name = $this->definition->name;
        $this->code = $this->definition->code;
        $this->barcode = $this->definition->barcode;
        $this->madin = $this->definition->madin;
        $this->type_id = $this->definition->type_id;
        $this->is_active = $this->definition->is_active;

        // Set current image path if exists
        if ($this->definition->image) {
            $this->current_image = asset('storage/' . $this->definition->image);
        }
    }

    public function removeImage()
    {
        $this->remove_image = true;
        $this->current_image = null;
        $this->new_image = null;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255',
            'barcode' => 'nullable|string|max:255',
            'madin' => 'nullable|string|max:255',
            'type_id' => 'required|exists:types,id',
            'is_active' => 'required',
            'new_image' => 'nullable|image|max:2048',
        ]);

        $updateData = [
            'name' => $this->name,
            'code' => $this->code,
            'barcode' => $this->barcode,
            'madin' => $this->madin,
            'type_id' => $this->type_id,
            'is_active' => $this->is_active,
        ];

        // Handle image updates
        if ($this->remove_image) {
            // Delete old image if exists
            if ($this->definition->image && Storage::disk('public')->exists($this->definition->image)) {
                Storage::disk('public')->delete($this->definition->image);
            }
            $updateData['image'] = null;
        } elseif ($this->new_image) {
            // Delete old image if exists
            if ($this->definition->image && Storage::disk('public')->exists($this->definition->image)) {
                Storage::disk('public')->delete($this->definition->image);
            }
            // Store new image
            $path = $this->new_image->store('definitions', 'public');
            $updateData['image'] = $path;
            $this->new_image->delete();
        }

        $this->definition->update($updateData);

        flash()->addSuccess('تم تحديث المنتج بنجاح.');
        return redirect()->route('definitions.create');
    }

    public function render()
    {
        return view('livewire.definitions.edit', [
            'types' => Type::all(),
        ]);
    }
}

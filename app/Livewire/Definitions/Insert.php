<?php

namespace App\Livewire\Definitions;

use App\Models\Definition;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Type;
use App\Models\Product;

class Insert extends Component
{
    use WithFileUploads;
    #[Validate('required|unique:definitions,name')]
    public $name = '';
    #[Validate('required|unique:definitions,barcode')]
    public $barcode = '';
    #[Validate('required|unique:definitions,code')]
    public $code = '';
    #[Validate('required|exists:types,id')]
    public $type_id = '';

    #[Validate('nullable')]
    public $madin = '';

    #[Validate('nullable|image|max:2048')]
    public $image;
    public $definition_id;
    #[Validate('required')]
    public $is_active = '';

    public $quantity = 0;
    public $price_sell = 0;

    public $testinser = false;
    public function store()
    {
        $validated = $this->validate();

        if ($this->image) {
            $validated['image'] = $this->image->store('Product', 'public');
        }

        Definition::create($validated);
        $this->definition_id = Definition::latest('id')->first()?->id;


        Product::create([

            'quantity'  => 0,
            'price_sell' => 0,
            'definition_id' => $this->definition_id,
        ]);


        flash()->Success('تم الإضافة بنجاح.');

       

        return redirect()->route('definitions.create');
    }



    public function render()
    {
        return view('livewire.definitions.insert', [
            'types' => type::paginate(10)
        ]);
    }
}

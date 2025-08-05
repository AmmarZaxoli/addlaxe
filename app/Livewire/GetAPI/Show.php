<?php

namespace App\Livewire\GetAPI;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
class Show extends Component
{
    public $temperature;


    public $email = 'ammarzaxoli95@gmail.com';
    public $password = '12345678';
    public $responseMessage;
    public function mount()
    {
        $this->submit();
    }

    public function submit()
    {
        $response = Http::post('https://laxe-backend-production.up.railway.app/api/v1/auth/signin', [
            'email' => $this->email,
            'password' => $this->password,
        ]);

        if ($response->successful()) {
            $this->responseMessage = 'Submitted successfully!';

            $this->gitdataapi($response->json()['token']);
        } else {
            $this->responseMessage = 'Submission failed!';
        }
    }

    public function gitdataapi($token)
    {
        $response = Http::withToken($token)->get('https://laxe-backend-production.up.railway.app/api/v1/orders/all?page=1&limit=4&status=PENDING');
        dd($response->json());
    }

    public function render()
    {
        return view('livewire.get-a-p-i.show');
    }
}

<?php

namespace App\Livewire;

use Livewire\Component;

class TarjetaPerfil extends Component
{
    protected $listeners = ['datosGuardados'];
    public $photo;
    public $photo_url;
    public $name;
    public $role;
    public $email;

    public function mount()
    {
        $this->photo = auth()->user()->profile_photo_path;
        $this->photo_url = auth()->user()->profile_photo_url;
        $this->name = auth()->user()->name;
        $this->role = auth()->user()->role;
        $this->email = auth()->user()->email;
    }

    public function datosGuardados()
    {
        $this->mount();
    }


    public function render()
    {
        return view('livewire.tarjeta-perfil');
    }
}

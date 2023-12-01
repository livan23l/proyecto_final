<?php

namespace App\Livewire;

use Livewire\Component;

class InformacionUsuario extends Component
{
    protected $listeners = ['datosGuardados'];
    public $description;
    public $name;
    public $state;
    public $email;
    public $role;
    public $created_at;

    public function mount()
    {
        $this->description = auth()->user()->description;
        $this->name = auth()->user()->name;
        $this->state = auth()->user()->state;
        $this->email = auth()->user()->email;
        $this->role = auth()->user()->role;
        $this->created_at = auth()->user()->created_at;
    }

    public function datosGuardados()
    {
        $this->mount();
    }

    public function render()
    {
        return view('livewire.informacion-usuario');
    }
}

<?php

namespace App\Livewire;

use App\Models\Estado;
use App\Models\User;
use Livewire\Component;

class UserProfileEdit extends Component
{
    public $name;
    public $description;
    public $email;
    public $state;

    public function mount()
    {
        $this->name = auth()->user()->name;
        $this->description = auth()->user()->description;
        $this->email = auth()->user()->email;
        $this->state = auth()->user()->state;
    }

    public function saveChanges()
    {
        // Obtenemos el usuario como un modelo User:
        $user = User::find(auth()->user()->id);

        // Obtenemos todos los estados.
        $estados = Estado::pluck('nombre')->toArray();  // Convertimos los nombres a un arreglo.

        // Reglas de validación:
        $rules = [
            'name' => 'required|max:255',
            'description' => 'required|min:5|max:500',
            'email' => 'required|email',
            'state' => 'required|in:' . implode(',', $estados),
        ];

        // Mensajes de error:
        $messages = [
            'name.required' => 'El campo nombre es obligatorio.',
            'name.max' => 'El campo nombre no puede tener más de 255 caracteres.',
            'description.required' => 'El campo descripción es obligatorio.',
            'description.min' => 'El campo descripción debe tener al menos 5 caracteres.',
            'description.max' => 'El campo descripción no puede tener más de 500 caracteres.',
            'email.required' => 'El campo correo es obligatorio.',
            'email.email' => 'El formato del correo no es válido.',
            'state.required' => 'El campo estado es obligatorio.',
            'state.in' => 'Se ha ingresado un estado no reconocido.',
        ];

        $this->validate($rules, $messages);  // La validación.

        // Actualizamos:
        if ($user->update([
            'name' => $this->name,
            'description' => $this->description,
            'email' => $this->email,
            'state' => $this->state,
        ])) {  // Éxito.
            session()->flash('profile-update', [true, "Cambios guardados."]);
        } else {  // Error.
            session()->flash('profile-update', [false, "Error al actualizar perfil."]);
        }
    }

    public function render()
    {
        return view('livewire.user-profile-edit');
    }
}

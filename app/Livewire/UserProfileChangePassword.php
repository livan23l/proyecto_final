<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class UserProfileChangePassword extends Component
{
    public $cpassword;  // La contraseña actual en el formulario.
    public $npassword;  // La nueva contraseña.
    public $npassword_confirmation;  // Confirmación de la nueva contraseña

    public function mount()
    {
        $this->cpassword = "";
        $this->npassword = "";
        $this->npassword_confirmation = "";
    }

    public function validation()
    {
        $usuario = User::find(auth()->user()->id);  // Obtenemos el modelo del usuario logeado.

        // Reglas de validación:
        $rules = [
            'cpassword' => 'required',  // Que sea requerido.
            'npassword' => 'required|min:8|confirmed',  // Que sea requerida, mínimo 8 y en confirmada con el "_confirmation".
        ];
        
        // Mensajes de error:
        $messages = [
            'cpassword.required' => 'El campo contraseña actual es obligatorio.',
            'npassword.required' => 'El campo nueva contraseña es obligatorio.',
            'npassword.min' => 'La nueva contraseña debe tener al menos 8 caracteres.',
            'npassword.confirmed' => 'Las contraseñas no coinciden.',
        ];

        $this->validate($rules, $messages);  // La validación.

        // Verificamos que la contraseña actual sea correcta
        if (!Hash::check($this->cpassword, $usuario->password)) {
            session()->flash('password', [false, "La contraseña actual es incorrecta."]);
            return;
        }

        session()->flash('password', [true, "¿Estás seguro de que quieres cambiar la contraseña? Si lo haces se cerrará tu sesión "]);
    }

    public function change() {
        $usuario = User::find(auth()->user()->id);  // Obtenemos el modelo del usuario logeado.

        if ($this->npassword != $this->npassword_confirmation) {
            session()->flash('password', [false, "Ha ocurrido un error inesperado."]);
            return;
        }

        $usuario->update([
            'password' => Hash::make($this->npassword),
        ]);
    }

    public function render()
    {
        return view('livewire.user-profile-change-password');
    }
}

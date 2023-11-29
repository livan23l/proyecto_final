<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Contracts\UpdatesUserPasswords;
use Livewire\Component;

class UserProfileChangePassword extends Component
{
    /**
     * The component's state.
     *
     * @var array
     */
    public $state = [
        'current_password' => '',
        'password' => '',
        'password_confirmation' => '',
    ];

    /**
     * Update the user's password.
     *
     * @param  \Laravel\Fortify\Contracts\UpdatesUserPasswords  $updater
     * @return void
     */
    public function save_password(UpdatesUserPasswords $updater)
    {
        $usuario = User::find(auth()->user()->id);  // Obtenemos el modelo del usuario logeado.

        // Reglas de validación:
        $rules = [
            'state.current_password' => 'required',  // Que sea requerido.
            'state.password_confirmation' => 'required',
            'state.password' => 'required|min:8|confirmed',  // Que sea requerida, mínimo 8 y en confirmada con el "_confirmation".
        ];

        // Mensajes de error:
        $messages = [
            'state.current_password.required' => 'El campo contraseña actual es obligatorio.',
            'state.password_confirmation.required' => 'El campo de la confirmación de contraseña es obligatorio.',
            'state.password.required' => 'El campo de la nueva contraseña es obligatorio.',
            'state.password.min' => 'La nueva contraseña debe tener al menos 8 caracteres.',
            'state.password.confirmed' => 'Las contraseñas no coinciden. Vuelve a intentarlo',
        ];

        $this->validate($rules, $messages);  // La validación.


        // Verificamos que la contraseña actual sea igual a la registrada:
        if (!Hash::check($this->state['current_password'], $usuario->password)) {
            session()->flash('password', [false, "La contraseña actual es incorrecta."]);
            return;
        }

        // Verificamos que la nueva contraseña sea diferente de la contraseña anterior:
        if ($this->state['password'] == $this->state['current_password']) {
            session()->flash('password', [false, "La nueva contraseña no puede ser igual a la anterior."]);
            return;
        }

        session()->flash('password', [true, "Contraseña cambiada correctamente"]);

        $updater->update(Auth::user(), $this->state);

        if (request()->hasSession()) {
            request()->session()->put([
                'password_hash_' . Auth::getDefaultDriver() => Auth::user()->getAuthPassword(),
            ]);
        }
    }

    public function render()
    {
        return view('livewire.user-profile-change-password');
    }
}

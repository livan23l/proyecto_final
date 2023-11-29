<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Estado;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class UserProfileEdit extends Component
{
    use WithFileUploads;  // Para la carga de archivos.

    public $photo;
    public $name;
    public $description;
    public $email;
    public $state;

    public function mount()
    {
        $this->photo = auth()->user()->profile_photo_path;
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
            'photo' => 'nullable',
            'name' => 'required|max:255',
            'description' => 'required|min:5|max:500',
            'email' => 'required|email',
            'state' => 'required|in:' . implode(',', $estados),
        ];

        // Mensajes de error:
        $messages = [
            'photo.mimes' => 'El tipo del archivo no es el indicado.',
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

        // dd([$this->photo, $user->profile_photo_path]);

        if (isset($this->photo)) {
            $user->updateProfilePhoto($this->photo);
            Storage::put('public/profile-photos', $this->photo);
        }

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

    public function deleteProfilePhoto()
    {
        // Obtenemos el usuario como un modelo User:
        $user = User::find(auth()->user()->id);


        if ($user->profile_photo_path) {
            $user->deleteProfilePhoto();
            session()->flash('profile-update', [true, "Foto eliminada correctamente."]);
        } else {
            session()->flash('profile-update', [false, "No tienes foto de perfil."]);
        }

        $this->reset();
    }

    public function render()
    {
        return view('livewire.user-profile-edit');
    }
}

<div>
    <form action="#" method="#">
        <div class="row mb-3 align-items-center"> <!-- Imagen -->
            <label for="profileImage" class="col-md-4 col-lg-3 col-form-label mb-2">Imagen de perfil</label>
            <div class="col-md-8 col-lg-9">
                <div class="">
                    @if (Auth::user()->profile_photo_path)
                        <img class="h-8 w-8 rounded-full object-cover" src="/storage/{{ Auth::user()->profile_photo_path }}" alt="{{ Auth::user()->name }}" />
                    @else
                        <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                    @endif
                </div>

                <input type="file" class="btn btn-primary btn-sm mx-1" alt="Cambiar foto de perfil" title="Cambiar foto de perfil"" wire:model="photo" x-ref="photo" /><i class="bi bi-upload"></i>

                <div class="pt-2">
                    {{-- <a href="#" class="btn btn-primary btn-sm mx-1" alt="Cambiar foto de perfil" title="Cambiar foto de perfil" x-on:click="$refs.photo.click()">/a> --}}
                    <a href="#" class="btn btn-danger btn-sm mx-1" alt="Eliminar foto de perfil" title="Eliminar foto de perfil" wire:click="deleteProfilePhoto"><i class="bi bi-trash"></i></a>
                </div>
            </div>
        </div>

        <div class="row mb-3"> <!-- Nombre -->
            <label for="name" class="col-md-4 col-lg-3 col-form-label">Nombre</label>
            <div class="col-md-8 col-lg-9">
                <input name="name" type="text" class="form-control" id="name" wire:model="name" autocomplete="off" required />
            </div>
        </div>

        <div class="row mb-3"> <!-- Descripcion -->
            <label for="description" class="col-md-4 col-lg-3 col-form-label">Descripción</label>
            <div class="col-md-8 col-lg-9">
                <textarea name="description" class="form-control" id="description" wire:model="description" style="height: 100px" autocomplete="off" required></textarea>
            </div>
        </div>

        <div class="row mb-3"> <!-- Correo -->
            <label for="email" class="col-md-4 col-lg-3 col-form-label">Correo</label>
            <div class="col-md-8 col-lg-9">
                <input name="email" type="email" class="form-control" id="email" wire:model="email" autocomplete="off" required />
            </div>
        </div>

        <div class="row mb-3"> <!-- Estado -->
            <label class="col-md-4 col-lg-3 col-form-label" for="state">Estado</label>
            <div class="col-md-8 col-lg-9">
                <select class="form-select" name="zona" id="state" wire:model="state" aria-label="Default select example">
                    @foreach (App\Models\Estado::all() as $estado)
                        <option value="{{ $estado->nombre }}">
                            {{ $estado->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </form>

    <div class="text-center">
        <button id="btn-update-profile" class="btn btn-primary" wire:click="saveChanges">Guardar cambios</button>
    </div>

    <div id="changes-profile-message" class="text-center mt-2">
        @if (session('profile-update'))
            <x-alert-component id="" tipo="{{ session('profile-update')[0] ? 'success' : 'danger' }}" icono="{{ session('profile-update')[0] ? 'bi-check-circle' : 'bi-exclamation-octagon' }}" mensaje="{{ session('profile-update')[1] }}" />
        @else
            @if ($errors->any())
                <x-alert-component id="" tipo="danger" icono="bi-exclamation-octagon" mensaje="errocito chiquitito" />
            @endif
        @endif
    </div>
</div>

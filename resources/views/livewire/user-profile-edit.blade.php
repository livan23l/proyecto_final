<div>
    <form wire:submit.prevent="saveChanges">
        <div class="row mb-3"> <!-- Imagen -->
            <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Imagen de perfil</label>
            <div class="col-md-8 col-lg-9">
                <img src="{{ asset('NiceAdmin/assets/img/profile-img.jpg') }}" alt="Profile">
                <div class="pt-2">
                    <a href="#" class="btn btn-primary btn-sm" title="Upload new profile image"><i class="bi bi-upload"></i></a>
                    <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></a>
                </div>
            </div>
        </div>

        <div class="row mb-3"> <!-- Nombre -->
            <label for="name" class="col-md-4 col-lg-3 col-form-label">Nombre</label>
            <div class="col-md-8 col-lg-9">
                <input name="name" type="text" class="form-control" id="name" wire:model="name" required />
            </div>
        </div>

        <div class="row mb-3"> <!-- Descripcion -->
            <label for="description" class="col-md-4 col-lg-3 col-form-label">Descripción</label>
            <div class="col-md-8 col-lg-9">
                <textarea name="description" class="form-control" id="description" wire:model="description" style="height: 100px" required></textarea>
            </div>
        </div>

        <div class="row mb-3"> <!-- Correo -->
            <label for="email" class="col-md-4 col-lg-3 col-form-label">Correo</label>
            <div class="col-md-8 col-lg-9">
                <input name="email" type="email" class="form-control" id="email" wire:model="email" required />
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
            <x-alert-component id="" tipo="{{ (session('profile-update'))[0] ? 'success' : 'danger' }}"
                               icono="{{ (session('profile-update'))[0] ? 'bi-check-circle' : 'bi-exclamation-octagon' }}"
                               mensaje="{{ session('profile-update')[1] }}" />
        @else
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                <x-alert-component id="" tipo="danger" icono="bi-exclamation-octagon" mensaje="{{ $error }}" />
                @endforeach
            @endif
        @endif
    </div>
</div>

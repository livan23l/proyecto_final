<div>
    <form action="#" method="#">
        <div class="row mb-3">
            <div class="form-floating col-md-12 col-lg-12">
                <input class="form-control" name="current_password" type="password" id="current_password" placeholder="Contraseña actual" autocomplete="off" wire:model="state.current_password" />
                <label class="form-label ms-2" for="current_password">Contraseña actual</label>
            </div>
        </div>

        <div class="row mb-3">
            <div class="form-floating col-md-12 col-lg-12">
                <input class="form-control" name="password" type="password" id="password" placeholder="Nueva contraseña" autocomplete="off" wire:model="state.password" />
                <label class="form-label ms-2" for="password">Nueva contraseña</label>
            </div>
        </div>

        <div class="row mb-3">
            <div class="form-floating col-md-12 col-lg-12">
                <input class="form-control" name="password_confirmation" type="password" id="password_confirmation" placeholder="Confirma tu nueva contraseña" autocomplete="off" wire:model="state.password_confirmation" />
                <label class="form-label ms-2" for="password_confirmation">Confirma tu nueva contraseña</label>
            </div>
        </div>
    </form>

    <div class="text-center">
        <button id="btn-update-profile" class="btn btn-primary" wire:click="save_password">Cambiar contraseña</button>
    </div>

    <div id="changes-profile-message" class="text-center mt-2">
        @if (session('password'))
            @if (session('password')[0])
                <x-alert-component id="" tipo="success" icono="bi-check-circle" mensaje="{{ session('password')[1] }}" />
            @else
                <x-alert-component id="" tipo="danger" icono="bi-exclamation-octagon" mensaje="{{ session('password')[1] }}" />
            @endif
        @else
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <x-alert-component id="" tipo="danger" icono="bi-exclamation-octagon" mensaje="{{ $error }}" />
                @endforeach
            @endif
        @endif
    </div>
</div>

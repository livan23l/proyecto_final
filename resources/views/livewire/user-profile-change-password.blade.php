<div>
    <form wire:submit.prevent="validation">
        <div class="row mb-3">
            <div class="form-floating col-md-12 col-lg-12">
                <input class="form-control" name="password" type="password" id="currentPassword" placeholder="Contraseña actual" wire:model="cpassword" />
                <label class="form-label ms-2" for="currentPassword">Contraseña actual</label>
            </div>
        </div>

        <div class="row mb-3">
            <div class="form-floating col-md-12 col-lg-12">
                <input class="form-control" name="npassword" type="password" id="npassword" placeholder="Nueva contraseña" wire:model="npassword" />
                <label class="form-label ms-2" for="npassword">Nueva contraseña</label>
            </div>
        </div>

        <div class="row mb-3">
            <div class="form-floating col-md-12 col-lg-12">
                <input class="form-control" name="npassword_confirmation" type="password" id="npassword_confirmation" placeholder="Confirma tu nueva contraseña" wire:model="npassword_confirmation" />
                <label class="form-label ms-2" for="npassword_confirmation">Confirma tu nueva contraseña</label>
            </div>
        </div>

        <div class="text-center">
            <button id="btn-update-profile" class="btn btn-primary" wire:click="validation">Cambiar contraseña</button>
        </div>

        <div id="changes-profile-message" class="text-center mt-2">
            @if (session('password'))
                @if (session('password')[0])
                    <div>
                        <div id="" class="alert alert-info alert-dismissible bg-info text-light border-0 fade show">
                            <i class="bi bi-info-circle me-1"></i>
                            {{session('password')[1]}}
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                            <div class="text-center">
                                <button id="btn-update-profile" class="btn btn-warning mt-2" wire:click="change">
                                    Confirmar
                                </button>
                            </div>
                        </div>
                    </div>
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
    </form>
</div>

<x-action-section>
    <x-slot name="title">
        {{ __('Autenticación en dos factores') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Agrega seguridad adicional a tu cuenta utilizando la autenticación en dos factores.') }}
    </x-slot>

    <x-slot name="content">
        <h3 class="text-lg font-medium text-center">
            @if ($this->enabled)
                @if ($showingConfirmation)
                    {{ __('Se ha terminado de habilitar la autenticación') }}
                @else
                    {{ __('Ya has activado la configuración en dos factores') }}
                @endif
            @else
                {{ __('No has activado la atenticación en dos factores') }}
            @endif
        </h3>

        <div class="mt-3 max-w-xl text-sm text-center">
            <p>
                {{ __('Cuando la autenticación de dos factores está habilitada, se le solicitará un token aleatorio seguro durante la autenticación. Puede recuperar este token desde la aplicación Google Authenticator de su teléfono.') }}
            </p>
        </div>

        @if ($this->enabled)
            @if ($showingQrCode)
                <div class="mt-4 max-w-xl text-sm">
                    <p class="font-semibold">
                        @if ($showingConfirmation)
                            {{ __('Para terminar de habilitar la autenticación de dos factores, escanee el siguiente código QR usando la aplicación de autenticación de su teléfono o ingrese la clave de configuración y proporcione el código OTP generado.') }}
                        @else
                            {{ __('La autenticación de dos factores ahora está habilitada. Escanee el siguiente código QR usando la aplicación de autenticación de su teléfono o ingrese la clave de configuración.') }}
                        @endif
                    </p>
                </div>

                <div class="mt-4 p-2 inline-block bg-white">
                    {!! $this->user->twoFactorQrCodeSvg() !!}
                </div>

                <div class="mt-4 max-w-xl text-sm ">
                    <p class="font-semibold">
                        {{ __('Clave de configuración') }}: {{ decrypt($this->user->two_factor_secret) }}
                    </p>
                </div>

                @if ($showingConfirmation)
                    <div class="mt-4">
                        <x-label for="code" value="{{ __('Código') }}" />

                        <div class="d-flex justify-content-center">
                            <x-input id="code" type="text" name="code" class="block mt-1 w-1/2" inputmode="numeric" autofocus autocomplete="one-time-code" wire:model="code" wire:keydown.enter="confirmTwoFactorAuthentication" />
                        </div>

                        <x-input-error for="code" class="mt-2" />
                    </div>
                @endif
            @endif

            @if ($showingRecoveryCodes)
                <div class="mt-4 max-w-xl text-sm text-gray-600 dark:text-gray-400">
                    <p class="font-semibold">
                        {{ __('Guarde estos códigos de recuperación en un administrador de contraseñas seguro. Se pueden utilizar para recuperar el acceso a su cuenta si pierde su dispositivo de autenticación de dos factores.') }}
                    </p>
                </div>

                <div class="grid gap-1 max-w-xl mt-4 px-4 py-4 font-mono text-sm bg-gray-100 dark:bg-gray-900 dark:text-gray-100 rounded-lg">
                    @foreach (json_decode(decrypt($this->user->two_factor_recovery_codes), true) as $code)
                        <div>{{ $code }}</div>
                    @endforeach
                </div>
            @endif
        @endif

        <div class="mt-5">
            @if (!$this->enabled)
                <div class="text-center">
                    <x-confirms-password wire:then="enableTwoFactorAuthentication">
                        <x-button type="button" wire:loading.attr="disabled">
                            {{ __('Activar') }}
                        </x-button>
                    </x-confirms-password>
                </div>
            @else
                @if ($showingRecoveryCodes)
                    <x-confirms-password wire:then="regenerateRecoveryCodes">
                        <x-secondary-button class="mr-3">
                            {{ __('Volver a generar códigos de recuperación') }}
                        </x-secondary-button>
                    </x-confirms-password>
                @elseif ($showingConfirmation)
                    <x-confirms-password wire:then="confirmTwoFactorAuthentication">
                        <x-button type="button" class="mr-3" wire:loading.attr="disabled">
                            {{ __('Confirmar') }}
                        </x-button>
                    </x-confirms-password>
                @else
                    <x-confirms-password wire:then="showRecoveryCodes">
                        <x-secondary-button class="mr-3">
                            {{ __('Mostrar códigos de recuperación') }}
                        </x-secondary-button>
                    </x-confirms-password>
                @endif

                @if ($showingConfirmation)
                    <x-confirms-password wire:then="disableTwoFactorAuthentication">
                        <x-secondary-button wire:loading.attr="disabled">
                            {{ __('Cancelar') }}
                        </x-secondary-button>
                    </x-confirms-password>
                @else
                    <x-confirms-password wire:then="disableTwoFactorAuthentication">
                        <x-danger-button wire:loading.attr="disabled">
                            {{ __('Desactivar') }}
                        </x-danger-button>
                    </x-confirms-password>
                @endif

            @endif
        </div>
    </x-slot>
</x-action-section>

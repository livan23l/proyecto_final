<x-template-principal>
    <h1>Votaciones creadas</h1>
    <hr />
    <br />
    @if (session('votacion'))
        <x-alert-component id="alert_votacion" tipo="{{ session('votacion')[1] ? 'success' : 'danger' }}" icono="{{ session('votacion')[1] ? 'bi-check-circle' : 'bi-exclamation-octagon' }}" mensaje="{{ session('votacion')[2] }}" />
    @endif
    @if ($votaciones->isEmpty())
        <div class="alert alert-danger text-center" role="alert">
            <h4 class="alert-heading">¡Atención!</h4>
            <p class="mb-0">No hay votaciones creadas.</p>
            <a class="mt-3 btn btn-success" href="/votacion/create">Crear una nueva votacion</a>
        </div>
    @else
        <div class="row justify-content-center">
            <div class="col-md-8">
                <ul class="list-group">
                    <li class="list-group-item bg-primary text-white">
                        <div class="d-flex align-items-center">
                            <span class="text-white text-center w-50">Nombre</span>
                            <span class="text-white text-center w-50">Opciones</span>
                        </div>
                    </li>
                    @foreach ($votaciones as $votacion)
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="w-50">
                                    <span>{{ $votacion->nombre }}</span>
                                </div>
                                <div class="w-50 text-center">
                                    <div class="align-items-center" role="group" aria-label="Opciones">
                                        <ul class="p-O">
                                            <x-botones-opciones-component tipo="votacion" id="{{$votacion->id}}" nombre="{{$votacion->nombre}}" msg="la votacion" />
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
</x-template-principal>

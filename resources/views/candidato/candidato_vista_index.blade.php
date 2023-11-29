<x-template-principal>
    <h1>Candidatos registrados</h1>
    <hr />
    <br />
    @if (session('candidato'))
        <x-alert-component id="alert_candidato" tipo="{{ session('candidato')[1] ? 'success' : 'danger' }}" icono="{{ session('candidato')[1] ? 'bi-check-circle' : 'bi-exclamation-octagon' }}" mensaje="{{ session('candidato')[2] }}" />
    @endif
    @if ($candidatos->isEmpty())
        <div class="alert alert-danger text-center" role="alert">
            <h4 class="alert-heading">¡Atención!</h4>
            <p class="mb-0">No hay candidatos registrados.</p>
            <a class="mt-3 btn btn-success" href="/candidato/create">Registrar un nuevo candidato</a>
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
                    @foreach ($candidatos as $candidato)
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="w-50">
                                    <span>{{ $candidato->nombre }}</span>
                                </div>
                                <div class="w-50 text-center">
                                    <div class="align-items-center" role="group" aria-label="Opciones">
                                        <ul class="p-O">
                                            <x-botones-opciones-component tipo="candidato" id="{{$candidato->id}}" nombre="{{$candidato->nombre}}" msg="el candidato" />
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

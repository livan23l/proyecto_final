<x-template-principal>
    <h1>Votaciones creadas:</h1>
    <hr />
    <br />
    @if(session('create_votacion'))
    <div id="alert_create_votacion" class="alert alert-success alert-dismissible bg-success text-light border-0 fade show">
        <i class="bi bi-check-circle me-1"></i>
        {{ session('create_votacion') }}
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    @if(session('destroy_votacion'))
    <div id="alert_destroy_votacion" class="alert alert-success alert-dismissible bg-success text-light border-0 fade show">
        <i class="bi bi-check-circle me-1"></i>
        {{ session('destroy_votacion') }}
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    @if(session('edit_votacion'))
    <div id="alert_edit_votacion" class="alert alert-success alert-dismissible bg-success text-light border-0 fade show">
        <i class="bi bi-check-circle me-1"></i>
        {{ session('edit_votacion') }}
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
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
                                    <li class="d-inline-block">
                                        <a class="btn btn-success" href="{{ route('votacion.show', $votacion->id) }}">Ver</a>
                                    </li>

                                    <li class="d-inline-block">
                                        <a class="btn btn-warning" href="{{ route('votacion.edit', $votacion->id) }}">Editar</a>
                                    </li>

                                    <li class="d-inline-block">
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete_btn_modal_{{$votacion->id}}">
                                            Borrar
                                        </button>

                                        <!-- Modal de eliminación -->
                                        <div class="modal fade" id="delete_btn_modal_{{$votacion->id}}" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="ModalLabel">Borrar votacion</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        ¿Está completamente seguro de que quiere eliminar al votacion '{{$votacion->nombre}}'?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancelar</button>
                                                        <form action="{{ route('votacion.destroy', $votacion) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Borrar</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
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

    <!-- Scripts -->
    @push('scripts')
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $('#alert_create_votacion').alert('close');
            }, 2000);

            setTimeout(function() {
                $('#alert_destroy_votacion').alert('close');
            }, 2000);

            setTimeout(function() {
                $('#alert_edit_votacion').alert('close');
            }, 2000);
        });
    </script>
    @endpush
</x-template-principal>
@stack('scripts')
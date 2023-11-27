<x-template-principal>
    <h1>Noticias publicadas</h1>
    <hr />
    <br />
    @if (session('noticia'))
        <x-alert-component id="alert_noticia"
                           tipo="{{ session('noticia')[0] ? 'success' : 'danger' }}"
                           icono="{{ session('noticia')[0] ? 'bi-check-circle' : 'bi-exclamation-octagon' }}"
                           mensaje="{{ session('noticia')[1] }}" />
    @endif
    @if ($noticias->isEmpty())
        <div class="alert alert-danger text-center" role="alert">
            <h4 class="alert-heading">¡Atención!</h4>
            <p class="mb-0">No hay noticias publicadas.</p>
            <a class="mt-3 btn btn-success" href="/noticia/create">Publicar una nueva noticia</a>
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
                    @foreach ($noticias as $noticia)
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="w-50">
                                    <span>{{ $noticia->titulo }}</span>
                                </div>
                                <div class="w-50 text-center">
                                    <div class="align-items-center" role="group" aria-label="Opciones">
                                        <ul class="p-O">
                                            <li class="d-inline-block">
                                                <a class="btn btn-success" href="{{ route('noticia.show', $noticia->id) }}">Ver</a>
                                            </li>

                                            <li class="d-inline-block">
                                                <a class="btn btn-warning" href="{{ route('noticia.edit', $noticia->id) }}">Editar</a>
                                            </li>

                                            <li class="d-inline-block">
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete_btn_modal_{{ $noticia->id }}">
                                                    Borrar
                                                </button>

                                                <!-- Modal de eliminación -->
                                                <div class="modal fade" id="delete_btn_modal_{{ $noticia->id }}" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="ModalLabel">Borrar noticia</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                ¿Está completamente seguro de que quiere eliminar al noticia {{ $noticia->nombre }}?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancelar</button>
                                                                <form action="{{ route('noticia.destroy', $noticia) }}" method="POST">
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
</x-template-principal>

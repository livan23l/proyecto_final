@props(['tipo', 'id', 'nombre', 'msg'])

<div>
    <a class="btn btn-primary mx-1" href="{{ route($tipo . '.index') }}">Volver</a> <!-- Volver -->
    <a class="btn btn-warning mx-1" href="{{ route($tipo . '.edit', $id) }}">Editar</a> <!-- Editar -->
    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete_btn_modal_{{ $id }}"> <!-- Borrar -->
        Borrar
    </button>

    <!-- Modal de eliminación -->
    <div class="modal fade" id="delete_btn_modal_{{ $id }}" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="ModalLabel">Borrar {{$tipo}}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Está completamente seguro de que quiere eliminar {{ $msg }} <i>{{ $nombre }}</i>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancelar</button>
                    <form action="{{ route($tipo . '.destroy', $id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Borrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

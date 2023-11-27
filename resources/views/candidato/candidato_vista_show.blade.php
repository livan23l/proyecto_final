<x-template-principal>
    <div class="card rounded-4">
        <div class="card-body">
            <h1 class="card-title">Información del candidato:</h1>
            <hr />

            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <h2>Nombre: {{ $candidato->nombre }}</h2>
                </li>
                <li class="list-group-item">
                    <h4>Partido: {{ $candidato->partido }}</h4>
                </li>
                <li class="list-group-item">
                    <p>Fecha de Nacimiento: {{ $candidato->f_nac }}</p>
                </li>
                <li class="list-group-item">
                    <p>Descripción: {{ $candidato->descripcion }}</p>
                </li>
            </ul>
        </div>
    </div>
    <div class="text-center">
        <a class="btn btn-success" href="{{ route('candidato.index') }}">Volver</a>
        <a class="btn btn-warning" href="{{ route('candidato.edit', $candidato->id) }}">Editar</a>
        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete_btn_modal_{{ $candidato->id }}">
            Borrar
        </button>

        <!-- Modal de eliminación -->
        <div class="modal fade" id="delete_btn_modal_{{ $candidato->id }}" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="ModalLabel">Borrar candidato</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        ¿Está completamente seguro de que quiere eliminar al candidato {{ $candidato->nombre }}?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancelar</button>
                        <form action="{{ route('candidato.destroy', $candidato) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Borrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-template-principal>

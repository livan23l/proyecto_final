<x-template-nice-admin>
    <h1>Candidatos registrados:</h1>
    <hr />
    <br />
    <table class="table table-light table-striped table-bordered border-primary">
        <thead>
            <th>Nombre</th>
            <th>Fecha de nacimiento</th>
            <th>Partido</th>
            <th>Descripción</th>
            <th>Opciones</th>
        </thead>
        <tbody>
            @foreach ($candidatos as $candidato)
                <tr>
                    <td>{{ $candidato->nombre }}</td>
                    <td>{{ $candidato->f_nac }}</td>
                    <td>{{ $candidato->partido }}</td>
                    <td>{{ $candidato->descripcion }}</td>
                    <td>
                        <table>
                            <td>
                                <a href="{{ route('candidato.show', $candidato->id) }}">
                                    Ver más
                                </a>
                            </td>
                            <td class="mx-2">
                                <a href="{{ route('candidato.edit', $candidato->id) }}">
                                    Editar
                                </a>
                            </td>
                            <td>
                                <form action="{{ route('candidato.destroy', $candidato) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" value="Borrar">
                                </form>
                            </td>
                        </table>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</x-template-nice-admin>

<x-template-nice-admin>
    <h1>Candidatos registrados:</h1>
    <hr />
    <br />
    <div class="d-flex justify-content-center container">
        <div class="row">
            <table class="table table-light table-striped table-bordered border-primary text-center">
                <div class="col-sm-10 col-md-10 col-lg-10 col-xl-10">
                    <thead>
                        <th>Nombre</th>
                        <th>Opciones</th>
                    </thead>
                </div>
                <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2">
                    <tbody>
                        @foreach ($candidatos as $candidato)
                        <tr>
                            <td>{{ $candidato->nombre }}</td>
                            <td>
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <a class="btn btn-success" href="{{ route('candidato.show', $candidato->id) }}">
                                        Ver
                                    </a>
                                    <a class="btn btn-warning" href="{{ route('candidato.edit', $candidato->id) }}">
                                        Editar
                                    </a>
                                    <form action="{{ route('candidato.destroy', $candidato) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input class="btn btn-danger" type="submit" value="Borrar">
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </div>
            </table>
        </div>
    </div>

</x-template-nice-admin>
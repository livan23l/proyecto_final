<x-template-nice-admin>
    <h1>Información del candidato '{{ $candidato->nombre }}':</h1>
    <hr />
    <br />
    <table class="table table table-light table-striped table-bordered border-primary">
        <thead>
            <th>Nombre</th>
            <th>Fecha de nacimiento</th>
            <th>Partido</th>
            <th>Descripción</th>
        </thead>
        <tbody>
            
            <tr>
                <td>{{ $candidato->f_nac }}</td>
                <td>{{ $candidato->nombre }}</td>
                <td>{{ $candidato->partido }}</td>
                <td>{{ $candidato->descripcion }}</td>
            </tr>
        </tbody>
    </table>
</x-template-nice-admin>

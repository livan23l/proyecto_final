<x-template-nice-admin>
    <h1>Información del candidato '{{ $candidato->nombre }}':</h1>
    <table class="table">
        <thead>
            <td>Fecha de nacimiento</td>
            <td>Nombre</td>
            <td>Partido</td>
            <td>Descripción</td>
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

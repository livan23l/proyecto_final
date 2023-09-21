<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Candidatos</title>
</head>

<body>
    <header>
        <div class="menu">
            <a href="/candidato">Ver candidatos</a>
            <a href="/candidato/create">Agregar un nuevo candidato</a>
        </div>
    </header>
    <h1>Candidatos registrados:</h1>
    <table>
        <thead>
            <throw>
                <td>Nombre</td>
                <td>Fecha de nacimiento</td>
                <td>Partido</td>
                <td>Descripción</td>
            </throw>
        </thead>
        <tbody>
            @foreach ($candidatos as $candidato)
                <tr>
                    <a href="{{route('candidato.show'), $candidato}}">
                        <td>{{$candidato->nombre}}</td>
                        <td>{{$candidato->f_nac}}</td>
                        <td>{{$candidato->partido}}</td>
                        <td>{{$candidato->descripcion}}</td>
                    </a>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
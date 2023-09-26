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
    <h1>Formulario para crear un nuevo candidato</h1>
    <form action="{{route('candidato.update', $candidato)}}" method="POST">
        @csrf
        @method('PATCH')
        <label for="candidato_nombre">Nombre: </label>
        <input type="text" name="candidato_nombre" value="{{$candidato->nombre}}"/>
        <br/>
        <label for="candidato_f_nac">Fecha de nacimiento: </label>
        <input type="date" name="candidato_f_nac" value="{{$candidato->f_nac}}"/>
        <br/>
        <label for="candidato_partido">Partido: </label>
        <input type="text" name="candidato_partido" value="{{$candidato->partido}}"/>
        <br/>
        <label for="candidato_descripcion">Descripcion: </label>
        <input type="text" name="candidato_descripcion" value="{{$candidato->descripcion}}"/>
        <br />
        <input type="submit" name="enviar" value="Guardar">
    </form>
</body>

</html>
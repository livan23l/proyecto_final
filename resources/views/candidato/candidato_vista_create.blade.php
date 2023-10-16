<x-template-nice-admin>
    <h1>Formulario para crear un nuevo candidato</h1>
    <form action="{{ route('candidato.index') }}" method="POST">
        @csrf
        <label for="candidato_nombre">Nombre: </label>
        <input type="text" name="candidato_nombre" />
        <br />
        <label for="candidato_f_nac">Fecha de nacimiento: </label>
        <input type="date" name="candidato_f_nac" />
        <br />
        <label for="candidato_partido">Partido: </label>
        <input type="text" name="candidato_partido" />
        <br />
        <label for="candidato_descripcion">Descripcion: </label>
        <input type="text" name="candidato_descripcion" />
        <br />
        <input type="submit" name="enviar">
    </form>
</x-template-nice-admin>

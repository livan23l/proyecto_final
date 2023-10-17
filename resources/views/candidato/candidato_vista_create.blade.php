<x-template-nice-admin>
    <h1>Formulario para crear un nuevo candidato</h1>
    <hr />
    <div class="contianer">
        <div class="row d-flex justify-content-center">
            <div class="col-sm-12 col-md-10 col-lg-8 col-xl-8">
                <form class="form" action="{{ route('candidato.index') }}" method="POST">
                    @csrf
                    <div class="form-floating my-2">
                        <input class="form-control" type="text" name="candidato_nombre" placeholder="nombre" />
                        <label class="form-label" for="candidato_nombre">Nombre</label>
                    </div>

                    <div class="form-floating my-2">
                        <input class="form-control" type="date" name="candidato_f_nac" placeholder="fecha" />
                        <label class="form-label" for="candidato_f_nac">Fecha de nacimiento</label>
                    </div>

                    <div class="form-floating my-2">
                        <input class="form-control" type="text" name="candidato_partido" placeholder="partido" />
                        <label class="form-label" for="candidato_partido">Partido</label>
                    </div>

                    <div class="form-floating my-2">
                        <textarea class="form-control" id="candidato_descripcion" name="candidato_descripcion" placeholder="descripcion"></textarea>
                        <label class="form-label" for="candidato_descripcion">Descripción</label>
                    </div>

                    <br />
                    <div class="d-flex justify-content-center">

                        <input class="btn btn-primary" type="submit" name="enviar">
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-template-nice-admin>

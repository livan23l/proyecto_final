<x-template-nice-admin>
    <h1>Creación de candidato</h1>
    <hr />
    <div class="contianer">
        <div class="row d-flex justify-content-center">
            <div class="col-sm-12 col-md-10 col-lg-8 col-xl-8">
                <form class="form" action="{{ route('candidato.index') }}" method="POST">
                    <div class="card">
                        <div class="card-body">
                            <h1 class="card-title text-center">Nuevo candidato</h1>
                            <hr />
                            @csrf
                            <li class="list-group list-group-flush">
                                <div class="form-floating my-2">
                                    <input class="form-control" type="text" name="nombre" placeholder="nombre" />
                                    <label class="form-label" for="nombre">Nombre</label>
                                </div>
                            </li>

                            <li class="list-group">
                                <div class="form-floating my-2">
                                    <input class="form-control" type="date" name="f_nac" placeholder="fecha" />
                                    <label class="form-label" for="f_nac">Fecha de nacimiento</label>
                                </div>
                            </li>

                            <li class="list-group">
                                <div class="form-floating my-2">
                                    <input class="form-control" type="text" name="partido" placeholder="partido" />
                                    <label class="form-label" for="partido">Partido</label>
                                </div>
                            </li>

                            <li class="list-group">
                                <div class="form-floating my-2">
                                    <textarea class="form-control" id="descripcion" name="descripcion" placeholder="descripcion"></textarea>
                                    <label class="form-label" for="descripcion">Descripción</label>
                                </div>
                            </li>

                            <li class="list-group">
                                <div class="d-flex justify-content-center">

                                    <input class="btn btn-primary" type="submit" name="enviar">
                                </div>
                            </li>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-template-nice-admin>
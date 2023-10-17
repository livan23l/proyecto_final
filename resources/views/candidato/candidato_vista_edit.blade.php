<x-template-nice-admin>
    <h1>Formulario para editar candidato</h1>
    <hr />
    <div class="contianer">
        <div class="row d-flex justify-content-center">
            <div class="col-sm-12 col-md-10 col-lg-8 col-xl-8">
                <form class="form" action="{{route('candidato.update', $candidato)}}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="form-floating my-2">
                        <input class="form-control" type="text" name="nombre" placeholder="nombre" value="{{$candidato->nombre}}"/>
                        <label class="form-label" for="nombre">Nombre</label>
                    </div>

                    <div class="form-floating my-2">
                        <input class="form-control" type="date" name="f_nac" placeholder="fecha" value="{{$candidato->f_nac}}"/>
                        <label class="form-label" for="f_nac">Fecha de nacimiento</label>
                    </div>

                    <div class="form-floating my-2">
                        <input class="form-control" type="text" name="partido" placeholder="partido" value="{{$candidato->partido}}"/>
                        <label class="form-label" for="partido">Partido</label>
                    </div>

                    <div class="form-floating my-2">
                        <textarea class="form-control" id="descripcion" name="descripcion" placeholder="descripcion">{{$candidato->descripcion}}</textarea>
                        <label class="form-label" for="descripcion">Descripción</label>
                    </div>

                    <br />
                    <div class="d-flex justify-content-center">
                        <input class="btn btn-primary" type="submit" value="enviar">
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-template-nice-admin>
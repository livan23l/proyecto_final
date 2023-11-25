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
                                    <input class="form-control" type="text" name="nombre" placeholder="nombre" value="{{old('nombre')}}" required maxlength="255" />
                                    <label class="form-label" for="nombre">Nombre</label>
                                    @error('nombre')
                                        <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                                            <i class="bi bi-exclamation-triangle me-1"></i>
                                            <strong>Error.</strong> El nombre ingresado es inválido.
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    @enderror
                                </div>
                            </li>

                            <li class="list-group">
                                <div class="form-floating my-2">
                                    <input class="form-control" type="date" name="f_nac" placeholder="fecha" value="{{old('f_nac')}}" required />
                                    <label class="form-label" for="f_nac">Fecha de nacimiento</label>
                                    @error('f_nac')
                                        <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                                            <i class="bi bi-exclamation-triangle me-1"></i>
                                            <strong>Error.</strong> La fecha es inválida. Debe tener al menos 18 años.
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    @enderror
                                </div>
                            </li>

                            <li class="list-group my-2">
                                <select class="form-select" aria-label="Default select example" name="partido" >
                                    <option selected disabled>Partido</option>
                                    <option {{(old('partido')=="MC") ? "selected" : ""}} value="MC">MC (Movimiento Ciudadano)</option>
                                    <option {{(old('partido')=="MORENA") ? "selected" : ""}} value="MORENA">MORENA (Movimiento de Regeneración Nacional)</option>
                                    <option {{(old('partido')=="PAN") ? "selected" : ""}} value="PAN">PAN (Partido Acción Nacional)</option>
                                    <option {{(old('partido')=="PRD") ? "selected" : ""}} value="PRD">PRD (Partido Revolucionario Democrático)</option>
                                    <option {{(old('partido')=="PRI") ? "selected" : ""}} value="PRI">PRI (Partido Revolucionario Institucional)</option>
                                    <option {{(old('partido')=="PT") ? "selected" : ""}} value="PT">PT (Partido del Trabajo)</option>
                                    <option {{(old('partido')=="PVEM") ? "selected" : ""}} value="PVEM">PVEM (Partido Verde Ecologista de México)</option>
                                </select>
                                @error('partido')
                                    <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                                        <i class="bi bi-exclamation-triangle me-1"></i>
                                        <strong>Error.</strong> No se seleccionó un partido válido.
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @enderror
                            </li>

                            <li class="list-group">
                                <div class="form-floating my-2">
                                    <textarea class="form-control" id="descripcion" name="descripcion" placeholder="descripcion" required >{{old('descripcion')}}</textarea>
                                    <label class="form-label" for="descripcion">Descripción</label>
                                    @error('descripcion')
                                        <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                                            <i class="bi bi-exclamation-triangle me-1"></i>
                                            <strong>Error.</strong> La descripción ingresada es inválida.
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    @enderror
                                </div>
                            </li>

                            <li class="list-group">
                                <div class="mt-3 d-flex justify-content-center">
                                    <input class="btn btn-primary" type="submit" value="Guardar">
                                </div>
                            </li>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-template-nice-admin>

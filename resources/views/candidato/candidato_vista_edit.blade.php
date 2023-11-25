<x-template-nice-admin>
    <h1>Edición de candidato</h1>
    <hr />
    <div class="contianer">
        <div class="row d-flex justify-content-center">
            <div class="col-sm-12 col-md-10 col-lg-8 col-xl-8">
                <form class="form" action="{{ route('candidato.update', $candidato) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="card">
                        <div class="card-body">
                            <h1 class="card-title text-center">Información</h1>
                            <hr />
                            <li class="list-group-item">
                                <div class="form-floating my-2">
                                    <input class="form-control" type="text" name="nombre" placeholder="nombre" value="{{ $candidato->nombre }}" required maxlength="255" />
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
                            <li class="list-group-item">
                                <div class="form-floating my-2">
                                    <input class="form-control" type="date" name="f_nac" placeholder="fecha" value="{{ $candidato->f_nac }}" required />
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
                                <select class="form-select" aria-label="Default select example" name="partido">
                                    <option disabled>Partido</option>
                                    @foreach ($partidos as $partido)
                                        <option {{$candidato->partido == $partido->abreviacion ? 'selected' : '' }} value="{{ $partido->abreviacion }}">
                                            {{ $partido->abreviacion . ' (' . $partido->nombre . ')' }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('partido')
                                <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                                    <i class="bi bi-exclamation-triangle me-1"></i>
                                    <strong>Error.</strong> No se seleccionó un partido válido.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                @enderror
                            </li>
                            <li class="list-group-item">
                                <div class="form-floating my-2">
                                    <textarea class="form-control" id="descripcion" name="descripcion" placeholder="descripcion" required>{{ $candidato->descripcion }}</textarea>
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
                            <li class="list-group-item">
                                <br />
                                <div class="d-flex justify-content-center">
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
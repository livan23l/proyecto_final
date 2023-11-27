<x-template-principal>
    <h1>Edición de noticias</h1>
    <hr />
    <div class="contianer">
        <div class="row d-flex justify-content-center">
            <div class="col-sm-12 col-md-10 col-lg-8 col-xl-8">
                <form class="form" action="{{ route('noticia.update', $noticia) }}" method="POST">
                    @csrf
                    @method("PATCH")
                    <div class="card">
                        <div class="card-body">
                            <h1 class="card-title text-center">Nuevo noticia</h1>
                            <hr />

                            <li class="list-group list-group-flush"> <!-- Titulo -->
                                <div class="form-floating my-2">
                                    <input id="titulo" class="form-control" type="text" name="titulo" placeholder="Titulo" value="{{ $noticia->titulo }}" required maxlength="255" />
                                    <label class="form-label" for="titulo">Título</label>
                                    @error('titulo')
                                        <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                                            <i class="bi bi-exclamation-triangle me-1"></i>
                                            <strong>Error.</strong> El título ingresado es inválido.
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    @enderror
                                </div>
                            </li>

                            <li class="list-group mt-3"> <!-- Alcance -->
                                <div class="py-1 d-flex justify-content-center align-items-center border rounded-2">
                                    <legend class="col-form-label col-sm-2">Alcance:</legend>
                                    <div class="d-flex justify-content-center align-items-center">
                                        <div class="form-check me-3">
                                            <input class="form-check-input" name="alcance" type="radio" id="alcance_federal" value="Federal" checked>
                                            <label class="form-check-label" for="alcance_federal">
                                                Federal
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" name="alcance" type="radio" id="alcance_estatal" value="Estatal" {{ $noticia->alcance == 'Estatal' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="alcance_estatal">
                                                Estatal
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                @error('alcance')
                                    <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                                        <i class="bi bi-exclamation-triangle me-1"></i>
                                        <strong>Error.</strong> El alcance ingresado no es válido.
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @enderror
                            </li>

                            <li class="list-group mt-3 mb-2"> <!-- Zona -->
                                <div id="lista_zona" class="{{ $noticia->alcance == 'Estatal' ? '' : 'd-none' }}"> <!-- Solo se mostrará si escoge "estatal" -->
                                    <label class="form-label mb-1 mx-1" for="select_zona">Selecciona la zona</label>
                                    <select class="form-select" name="zona" id="select_zona" aria-label="Default select example">
                                        @foreach ($estados as $estado)
                                            <option value="{{ $estado->nombre }}" {{ $noticia->zona == $estado->nombre ? 'selected' : '' }}>
                                                {{ $estado->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('zona')
                                    <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                                        <i class="bi bi-exclamation-triangle me-1"></i>
                                        <strong>Error.</strong> La descripción ingresada es inválida.
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @enderror
                            </li>

                            <li class="list-group mt-0 mb-1"> <!-- Contenido -->
                                <h5 class="card-title text-center">Escribe tu noticia</h5>
                                <div id="contenido_quill"></div>
                                <input id="contenido" type="hidden" name="contenido" value="{{ $noticia->contenido }}" required />
                            </li>
                            @error('contenido')
                                <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                                    <i class="bi bi-exclamation-triangle me-1"></i>
                                    <strong>Error.</strong> El contenido ingresado es insuficiente.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @enderror

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
</x-template-principal>

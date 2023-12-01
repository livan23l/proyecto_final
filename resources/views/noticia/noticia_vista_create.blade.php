<x-template-principal>
    <h1>Publicación de noticia</h1>
    <hr />
    <div class="contianer">
        <div class="row d-flex justify-content-center">
            <div class="col-sm-12 col-md-10 col-lg-8 col-xl-8">
                <form class="form" action="{{ route('noticia.index') }}" method="POST">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <h1 class="card-title text-center">Nueva noticia</h1>
                            <hr />

                            <li class="list-group list-group-flush"> <!-- Titulo -->
                                <div class="form-floating my-2">
                                    <input id="titulo" class="form-control" type="text" name="titulo" placeholder="Titulo" value="{{ old('titulo') }}" required maxlength="255" />
                                    <label class="form-label" for="titulo">Título</label>
                                    @error('titulo')
                                        <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                                            <i class="bi bi-exclamation-triangle me-1"></i>
                                            <strong>Error.</strong> El título ingresado es inválido. Debe tener al menos 2 caracteres.
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    @enderror
                                </div>
                            </li>

                            <li class="list-group mt-3"> <!-- Origen -->
                                <div class="py-1 d-flex justify-content-center align-items-center border rounded-2">
                                    <legend class="col-form-label col-sm-2">Origen:</legend>
                                    <div class="d-flex justify-content-center align-items-center">
                                        <div class="form-check me-3">
                                            <input class="form-check-input" name="origen" type="radio" id="origen_federal" value="Federal" checked>
                                            <label class="form-check-label" for="origen_federal">
                                                Federal
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" name="origen" type="radio" id="origen_estatal" value="Estatal" {{ old('origen') == 'Estatal' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="origen_estatal">
                                                Estatal
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                @error('origen')
                                    <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                                        <i class="bi bi-exclamation-triangle me-1"></i>
                                        <strong>Error.</strong> El origen ingresado no es válido.
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @enderror
                            </li>

                            <li class="list-group mt-3 mb-2"> <!-- Zona -->
                                <div id="lista_zona" class="{{ old('origen') == 'Estatal' ? '' : 'd-none' }}"> <!-- Solo se mostrará si escoge "estatal" -->
                                    <label class="form-label mb-1 mx-1" for="select_zona">Zona de origen:</label>
                                    <select class="form-select" name="zona" id="select_zona" aria-label="Default select example">
                                        @foreach ($estados as $estado)
                                            <option value="{{ $estado->nombre }}" {{ old('zona') == $estado->nombre ? 'selected' : '' }}>
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

                            <li class="list-group mt-3 border rounded p-3 shadow-sm"> <!-- Categorías -->
                                <div class="container">
                                    <div class="row align-items-center">

                                        <div class="col-sm-1 col-md-1 col-lg-1 col-xl-1 text-center"> <!-- Icono -->
                                            <i class="bi bi-search fs-4"></i>
                                        </div>

                                        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6"> <!-- Búsqueda de categorías -->
                                            <div id="categorias_insrt_all" class="form-floating">
                                                <input type="text" id="categorias_insrt" class="form-control" placeholder="Buscar categorías">
                                                <label for="categorias_insrt">Ingresar categorías</label>
                                            </div>

                                            <div id="alert_categorias" class="d-none"> <!-- Alerta -->
                                                <x-alert-component id="" tipo="danger" icono="bi-exclamation-octagon" mensaje="Error. Solo puedes incluir un máximo de 5 categorías." />
                                            </div>

                                            <div id="categorias_sugerencias" class="sugerencias d-none"></div>
                                        </div>

                                        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4"> <!-- Categorías seleccionadas -->
                                            <div class="row mt-2">
                                                <ul class="list-group col-md-12 text-center" id="categorias_seleccionadas"></ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @error('categorias')
                                <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                                    <i class="bi bi-exclamation-triangle me-1"></i>
                                    <strong>Error.</strong> Debe haber mínimo una categoría y máximo 5.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @enderror

                            <li class="list-group mt-0 mb-1"> <!-- Contenido -->
                                <h5 class="card-title text-center">Escribe tu noticia</h5>
                                <div id="contenido_quill"></div>
                                <input id="contenido" type="hidden" name="contenido" value="{{ old('contenido') }}" required />
                            </li>
                            @error('contenido')
                                <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                                    <i class="bi bi-exclamation-triangle me-1"></i>
                                    <strong>Error.</strong> El contenido ingresado es insuficiente.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @enderror

                            <input type="hidden" id="categ_all" value="{{ $categorias }}" />
                            <input type="hidden" name="categ_select" id="categ_select" value="{{ old('categ_select') }}" />

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

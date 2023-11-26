<x-template-principal>
    <h1>Edición de votación</h1>
    <hr />
    <div class="contianer">
        <div class="row d-flex justify-content-center">
            <div class="col-sm-12 col-md-10 col-lg-8 col-xl-8">
                <form class="form" action="{{ route('votacion.update', $votacion) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="card">
                        <div class="card-body">
                            <h1 class="card-title text-center">Información</h1>
                            <hr />

                            <li class="list-group list-group-flush"> <!-- Nombre -->
                                <div class="form-floating mt-2 mb-1">
                                    <input class="form-control" type="text" name="nombre" placeholder="nombre" value="{{ $votacion->nombre }}" required minlength="5" maxlength="255" />
                                    <label class="form-label" for="nombre">Nombre de la votacion</label>
                                    @error('nombre')
                                        <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                                            <i class="bi bi-exclamation-triangle me-1"></i>
                                            <strong>Error.</strong> El nombre ingresado es inválido.
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    @enderror
                                </div>
                            </li>

                            <li class="list-group mt-2 mb-3"> <!-- Tipo -->
                                <label class="form-label mx-1 mb-1" for="select_tipo">Tipo de votación</label>
                                <select name="tipo" id="select_tipo" class="form-select" aria-label="Default select example">
                                    <option {{ $votacion->tipo == 'Presidencial' ? 'selected' : '' }} value="Presidencial" selected>Presidencial</option>
                                    <option {{ $votacion->tipo == 'Diputación' ? 'selected' : '' }} value="Diputación">Diputación</option>
                                    <option {{ $votacion->tipo == 'Senaduría' ? 'selected' : '' }} value="Senaduría">Senaduría</option>
                                </select>
                                @error('tipo')
                                    <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                                        <i class="bi bi-exclamation-triangle me-1"></i>
                                        <strong>Error.</strong> El tipo ingresado no es válido.
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @enderror
                            </li>

                            <li class="list-group mt-3 mb-2"> <!-- Alcance -->
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
                                            <input class="form-check-input" name="alcance" type="radio" id="alcance_estatal" value="Estatal" {{ $votacion->alcance == 'Estatal' ? 'checked' : '' }}>
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

                            <li class="list-group mt-2 mb-3"> <!-- Zona -->
                                <div id="lista_zona" class="{{ $votacion->alcance == 'Estatal' ? '' : 'd-none' }}"> <!-- Solo se mostrará si escoge "estatal" -->
                                    <label class="form-label mb-1 mx-1" for="select_zona">Selecciona la zona</label>
                                    <select class="form-select" name="zona" id="select_zona" aria-label="Default select example">
                                        @foreach ($estados as $estado)
                                            <option value="{{ $estado->nombre }}" {{ $votacion->zona == $estado->nombre ? 'selected' : '' }}>
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

                            <li class="list-group"> <!-- Candidatos -->
                                <button type="button" class="btn btn-outline-secondary text-dark" data-bs-toggle="modal" data-bs-target="#modalCandidatos">
                                    Seleccionar candidatos
                                </button>

                                <div class="modal fade" id="modalCandidatos" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Selección de candidatos</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <ul class="list-unstyled">
                                                    @foreach ($candidatos as $candidato)
                                                        <li class="my-1 mx-2">
                                                            <input type="checkbox" id="candidato_{{ $candidato->id }}" name="candidatos[]" value="{{ $candidato->id }}" {{ $votacion->candidatos->contains($candidato->id) ? 'checked' : '' }}>
                                                            <label for="candidato_{{ $candidato->id }}">{{ $candidato->nombre }}</label>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <div class="modal-footer d-flex justify-content-center">
                                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Guardar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @error('candidatos')
                                    <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                                        <i class="bi bi-exclamation-triangle me-1"></i>
                                        <strong>Error.</strong> Se deben seleccionar al menos dos candidatos.
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @enderror

                                @error('candidatos.*')
                                    <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                                        <i class="bi bi-exclamation-triangle me-1"></i>
                                        <strong>Error.</strong> Se ha seleccionado un candidato inválido.
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @enderror
                            </li>

                            <li class="list-group mt-3"> <!-- Descripción -->
                                <div class="form-floating my-2">
                                    <textarea class="form-control" id="descripcion" name="descripcion" placeholder="descripcion" minlength="5" required>{{ $votacion->descripcion }}</textarea>
                                    <label class="form-label" for="descripcion">Descripción</label>
                                </div>
                                @error('descripcion')
                                    <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                                        <i class="bi bi-exclamation-triangle me-1"></i>
                                        <strong>Error.</strong> La descripción ingresada es inválida.
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @enderror
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
</x-template-principal>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var zona = document.getElementById('lista_zona');

        document.querySelectorAll('input[name="alcance"]').forEach(function(radioButton) {
            radioButton.addEventListener('change', function() {
                if (this.value === 'Estatal') {
                    zona.classList.remove("d-none");
                } else {
                    zona.classList.add("d-none");
                }
            });
        });
    });
</script>

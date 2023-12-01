<x-template-principal>
    <h1>Volverme periodista</h1>
    <hr />
    @if (session('peticion'))
        <x-alert-component id="alert_peticion" tipo="{{ session('peticion')[0] ? 'success' : 'danger' }}" icono="{{ session('peticion')[0] ? 'bi-check-circle' : 'bi-exclamation-octagon' }}" mensaje="{{ session('peticion')[1] }}" />
    @endif
    @if (!$peticion->isEmpty())
        <div class="card">
            <div class="card-body text-center">
                <h5 class="card-title">Tu petición está siendo procesada</h5>
                <hr />
                <p class="card-text">En cuanto nuestros moderadores la acepten, podrás empezar a crear noticias y compartirlas con el resto del país.</p>
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#basicModal">
                    Eliminar petición
                </button>
            </div>
        </div>

        <!-- Modal para confirmar la eliminación de la petición -->
        <div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-center">Eliminar petición</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        ¿Estás seguro de que quieres eliminar tu petición para volverte periodista? Aún podrás crear una solicitud nueva después.
                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancelar</button>
                        <form action="{{ route('noticia.periodista_destroy', $peticion[0]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Borrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="contianer">
            <div class="row d-flex justify-content-center">
                <div class="col-sm-12 col-md-10 col-lg-8 col-xl-8">
                    <form class="form" action="{{ route('noticia.periodista_store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <h1 class="card-title text-center">Para ser periodista rellena este simple formulario</h1>
                                <hr />

                                <li class="list-group list-group-flush"> <!-- Motivo -->
                                    <label class="form-label ms-1" for="motivo">Cuéntanos el motivo por el que quieres volverte periodista</label>
                                    <textarea class="form-control" id="motivo" name="motivo" placeholder="Quiero ser periodista porque..." minlength="20" required>{{ old('motivo') }}</textarea>
                                    @error('motivo')
                                        <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                                            <i class="bi bi-exclamation-triangle me-1"></i>
                                            <strong>Error.</strong> El motivo ingresado es muy corto, ingresa al menos 20 caracteres.
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    @enderror
                                </li>

                                <li class="list-group list-group-flush mt-3"> <!-- Identificación -->
                                    <div class="custom-file">
                                        <label class="form-label ms-1" for="identificacion">Sube un PDF con una identificación válida</label>
                                        <input type="file" class="custom-file-input my-2" id="identificacion" name="identificacion" />
                                    </div>
                                    @error('identificacion')
                                        <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                                            <i class="bi bi-exclamation-triangle me-1"></i>
                                            <strong>Error.</strong> Tipo de archivo inorrecto. Se solicita un PDF.
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    @enderror
                                </li>

                                <li class="list-group">
                                    <div class="mt-3 d-flex justify-content-center">
                                        <input class="btn btn-primary" type="submit" value="Enviar">
                                    </div>
                                </li>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</x-template-principal>

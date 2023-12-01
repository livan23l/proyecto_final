<x-template-principal>
    <h1>Mis noticias</h1>
    <hr />
    <br />
    @if (session('noticia'))
        <x-alert-component id="alert_noticia" tipo="{{ session('noticia')[0] ? 'success' : 'info' }}" icono="{{ session('noticia')[0] ? 'bi-check-circle' : 'bi-exclamation-octagon' }}" mensaje="{{ session('noticia')[1] }}" />
    @endif
    @if ($noticias->isEmpty())
        <div class="alert alert-danger text-center" role="alert">
            <h4 class="alert-heading">¡Ups!</h4>
            <p class="mb-0">Parece que no has publicado ninguna noticia</p>
            <a class="mt-3 btn btn-success" href="/noticia/create">Publicar una nueva noticia</a>
        </div>
    @else
        @foreach ($noticias as $noticia)
            <div class="card mb-4">
                <div class="card-header text-center position-relative">
                    {{ $noticia->origen }} | {{ $noticia->zona }}
                    <a href="{{ route('noticia.edit', $noticia) }}" class="color-edit position-absolute mx-5 mt-3 end-0 top-0 " style="text-decoration: none;" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar">
                        <i class="bi bi-pencil-square"></i>
                    </a>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="card-body">
                            <h2 class="card-title text-center">{{ $noticia->titulo }}</h2>
                            <hr />
                            <div class="card-text text-center">
                                <div id="contenido_quill_{{ $noticia->id }}"></div>
                                <input id="contenido_{{ $noticia->id }}" type="hidden" class="contenido" value="{{ $noticia->contenido }}" />
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        var quill = new Quill('#contenido_quill_{{ $noticia->id }}', {
                                            readOnly: true, // Para desactivar la edición.
                                        });

                                        var contenido = document.getElementById('contenido_{{ $noticia->id }}').value;

                                        quill.clipboard.dangerouslyPasteHTML(contenido);
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="card-info">
                            <div class="text-center max-w-75 m-auto">
                                <div class="border m-auto rounded-3 py-2 pe-3 text-center w-100">
                                    <h4><b>Categorías</b></h4>
                                    @foreach ($noticia->categorias as $categoria)
                                        <span class="badge bg-primary mb-2">{{ $categoria->nombre }}</span>
                                    @endforeach
                                </div>
                            </div>
                            <!-- Sección de likes -->
                            <form id="likeForm_{{ $noticia->id }}" action="{{ route('user.noticiaLike', $noticia->id) }}" method="POST">
                                @csrf
                                <div class="text-center max-w-75 m-auto mt-2" id="likeContainer" data-noticia-id="{{ $noticia->id }}">
                                    <div class="border m-auto rounded-3 py-2 ps-2 text-center">
                                        <h4><b>Candidad de likes</b></h4>
                                        <i class="bi bi-heart-fill fs-3 text-danger" id="likeIcon"></i>
                                        <p class="my-2">Esta noticia tiene {{ $noticia->votos_tot }} {{ $noticia->votos_tot == 1 ? 'voto' : 'votos' }}</p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="text-center my-4">
                    <a class="btn btn-primary" href="#">Ver</a>
                </div>

                <div class="card-footer text-center">
                    <span>Fecha de publicación: {{ $noticia->created_at }}</span>
                </div>
            </div>
        @endforeach
    @endif
</x-template-principal>

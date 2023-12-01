<x-template-principal>
    <!-- Title -->
    <div class="container text-center my-3">
        <h1 class="display-4">Las noticias del momento</h1>
        <p class="lead mt-3">
            Entérate de la información más <b>relevantes</b> del país <b>en segundos</b>.
        </p>
        <hr class="my-4">
    </div>
    <!-- End Title Section -->

    @if (session('noticia'))
        <x-alert-component id="alert_noticia" tipo="{{ session('noticia')[0] ? 'success' : 'info' }}" icono="{{ session('noticia')[0] ? 'bi-check-circle' : 'bi-exclamation-octagon' }}" mensaje="{{ session('noticia')[1] }}" />
    @endif
    @if (empty($noticiasRelevantes))
        <div class="alert alert-danger text-center" role="alert">
            <h4 class="alert-heading">¡Ups!</h4>
            <p class="mb-0">Parece que no se han publicado noticias</p>
            <i><a href="#">Contacta al soporte si crees que se trata de algún error</a></i>
        </div>
    @else
        @foreach ($noticiasRelevantes as $noticia)
            <div class="card mb-4">
                <div class="card-header text-center position-relative">
                    {{ $noticia["noticia"]->origen }} | {{ $noticia["noticia"]->zona }}
                    {{-- <a href="{{ route('noticia.edit', $noticia) }}" class="color-edit position-absolute mx-5 mt-3 end-0 top-0 " style="text-decoration: none;" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar">
                        <i class="bi bi-pencil-square"></i>
                    </a> --}}
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="card-body">
                            <h2 class="card-title text-center">{{ $noticia["noticia"]->titulo }}</h2>
                            <hr />
                            <div class="card-text text-center">
                                <div id="contenido_quill_{{ $noticia["noticia"]->id }}"></div>
                                <input id="contenido_{{ $noticia["noticia"]->id }}" type="hidden" class="contenido" value="{{ $noticia["noticia"]->contenido }}" />
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        var quill = new Quill('#contenido_quill_{{ $noticia["noticia"]->id }}', {
                                            readOnly: true, // Para desactivar la edición.
                                        });

                                        var contenido = document.getElementById('contenido_{{ $noticia["noticia"]->id }}').value;

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
                                    @foreach ($noticia["noticia"]->categorias as $categoria)
                                        <span class="badge bg-primary mb-2">{{ $categoria->nombre }}</span>
                                    @endforeach
                                </div>
                            </div>
                            <!-- Sección de likes -->
                            <form id="likeForm_{{$noticia["noticia"]->id}}" action="{{ route('user.noticiaLike', $noticia["noticia"]->id) }}" method="POST">
                                @csrf
                                <div class="text-center max-w-75 m-auto mt-2" id="likeContainer" data-noticia-id="{{ $noticia["noticia"]->id }}">
                                    <div class="border m-auto rounded-3 py-2 ps-2 text-center">
                                        @php
                                            $on = false;   
                                        @endphp
                                        @foreach($likes as $like)
                                            @if($like->noticia_id == $noticia["noticia"]->id && $like->user_id == auth()->user()->id)
                                                @php
                                                    $on = true;
                                                @endphp
                                            @endif
                                        @endforeach
                                        <h4><b>{{ $on ? 'Me gusta' : 'No me gusta' }}</b></h4>
                                        <!-- Eliminamos el botón de submit y usamos el icono como disparador -->
                                        <a class="text-danger" href="#" id="likeButton_{{$noticia["noticia"]->id}}">
                                            <i class="bi {{ $on ? 'bi-heart-fill' : 'bi-heart' }} fs-3" id="likeIcon"></i>
                                        </a>
                                        <p class="my-2">Esta noticia tiene {{$noticia["noticia"]->votos_tot}} {{$noticia["noticia"]->votos_tot == 1 ? 'voto' : 'votos'}}</p>
                                    </div>
                                </div>
                            </form>
                            <script>
                                // Agregamos un manejador de eventos para el clic en el icono
                                document.getElementById('likeButton_{{$noticia["noticia"]->id}}').addEventListener('click', function() {
                                    // Simulamos el clic en el botón de submit
                                    document.getElementById('likeForm_{{$noticia["noticia"]->id}}').submit();
                                });
                            </script>                            
                        </div>
                    </div>
                </div>
                <div class="text-center my-4">
                    <a class="btn btn-primary" href="#">Leer más</a>
                </div>

                <div class="card-footer text-center">
                    <span>Autor: {{$noticia["noticia"]->autor}}</span><br />
                    <span>Fecha de publicación: {{ $noticia["noticia"]->created_at }}</span>
                </div>
            </div>
        @endforeach
    @endif
</x-template-principal>
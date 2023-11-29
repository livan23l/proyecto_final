<x-template-principal>
    <h1>Mis noticiasRelevantes</h1>
    <hr />
    <br />
    @if (session('noticia'))
        <x-alert-component id="alert_noticia" tipo="{{ session('noticia')[0] ? 'success' : 'danger' }}" icono="{{ session('noticia')[0] ? 'bi-check-circle' : 'bi-exclamation-octagon' }}" mensaje="{{ session('noticia')[1] }}" />
    @endif
    @if ($noticiasRelevantes->isEmpty())
        <div class="alert alert-danger text-center" role="alert">
            <h4 class="alert-heading">¡Ups!</h4>
            <p class="mb-0">Parece que no has publicado ninguna noticia</p>
            <a class="mt-3 btn btn-success" href="/noticia/create">Publicar una nueva noticia</a>
        </div> {{--  @foreach ($noticiasRelevantes as $noticia)  @endforeach --}}
    @else
        @foreach ($noticiasRelevantes as $noticia)
            <div class="card mb-4">
                <div class="card-header text-center position-relative">
                    {{ $noticia["noticia"]->origen }} | {{ $noticia["noticia"]->zona }}
                    <a href="{{ route('noticia.edit', $noticia) }}" class="color-edit position-absolute mx-5 mt-3 end-0 top-0 " style="text-decoration: none;" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar">
                        <i class="bi bi-pencil-square"></i>
                    </a>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="card-body">
                            <h2 class="card-title text-center">{{ $noticia["noticia"]->titulo }}</h2>
                            <hr />
                            <p class="card-text text-center">{{ substr($noticia["noticia"]->contenido, 0, 200) }}...</p>
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
                                                    $votos = $like->votos;
                                                @endphp
                                            @endif
                                        @endforeach

                                        <h4><b>{{ $on ? 'Me gusta' : 'No me gusta' }}</b></h4>
                                        <!-- Eliminamos el botón de submit y usamos el icono como disparador -->
                                        <a class="text-danger" href="#" id="likeButton_{{$noticia["noticia"]->id}}">
                                            <i class="bi {{ $on ? 'bi-heart-fill' : 'bi-heart' }} fs-3" id="likeIcon"></i>
                                        </a>

                                        {{-- <p class="my-2">Esta noticia tiene {{isset($votos) ? $votos : 0}} votos</p> --}}
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
                    Fecha de publicación: {{ $noticia["noticia"]->created_at }}
                </div>
            </div>
        @endforeach










        {{-- <div class="row justify-content-center">
            <div class="col-md-8">
                <ul class="list-group">
                    <li class="list-group-item bg-primary text-white">
                        <div class="d-flex align-items-center">
                            <span class="text-white text-center w-50">Nombre</span>
                            <span class="text-white text-center w-50">Opciones</span>
                        </div>
                    </li>
                    @foreach ($noticiasRelevantes as $noticia)
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="w-50">
                                    <span>{{ $noticia->titulo }}</span>
                                </div>
                                <div class="w-50 text-center">
                                    <div class="align-items-center" role="group" aria-label="Opciones">
                                        <ul class="p-O">
                                            <x-botones-opciones-component tipo="noticia" id="{{ $noticia->id }}" nombre="{{ $noticia->titulo }}" msg="la noticia" />
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div> --}}
    @endif
</x-template-principal>
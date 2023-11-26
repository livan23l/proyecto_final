<x-template-principal>
    <!-- Title -->
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="pagetitle col-sm-12 col-md-4 col-lg-4 col-xl-4">
                <img src="{{ asset('NiceAdmin/assets/img/logo.png') }}" alt="Logo VERN" />
            </div>
            <div class="col-sm-12 col-md-8 col-lg-8 col-xl-8">
                <h2 class="">Votación Electrónica y Recomendación de noticias</h2>
            </div>
        </div>
        <hr />
    </div>
    <!-- End Title Section -->

    <!-- Principal part -->
    <div class="row">
        <div class="col-sm-12 col-md-5 col-lg-4 col-xl-4">
            <!-- Carousel -->
            <div class="card">
                <div class="card-body">
                    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
                        </div>
                        <div class="carousel-inner">
                            <!-- Voting -->
                            <div class="carousel-item active">
                                <div class="card">
                                    <img src="{{ asset('NiceAdmin/assets/img/electronic voting.jpg') }}" class="card-img-top" alt="voting image">
                                    <div class="card-body">
                                        <h5 class="card-title">Votación electrónica</h5>
                                        <p class="card-text">Vota de manera <b><i>electrónica, fácil y segura</i></b>
                                            por los candidatos a la presidencia de México</p>
                                    </div>
                                </div>
                            </div>
                            <!-- News -->
                            <div class="carousel-item">
                                <div class="card">
                                    <img src="{{ asset('NiceAdmin/assets/img/news.jpg') }}" class="card-img-top" alt="news image">
                                    <div class="card-body">
                                        <h5 class="card-title">Recomendación de noticias</h5>
                                        <p class="card-text">
                                            Infórmate de las noticias del momento con nuestro <i>sistema de
                                                recomendación de noticias</i> basado en tus preferencias.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!-- Forum -->
                            <div class="carousel-item">
                                <div class="card">
                                    <img src="{{ asset('NiceAdmin/assets/img/forum.jpg') }}" class="card-img-top" alt="forum image">
                                    <div class="card-body">
                                        <h5 class="card-title">Foro de propuestas</h5>
                                        <p class="card-text"><b>Comparte</b> tus propias propuestas de ley en un foro al
                                            resto de ciudadanos y
                                            vota por las que más te gusten.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Validation -->
                            <div class="carousel-item">
                                <div class="card">
                                    <img src="{{ asset('NiceAdmin/assets/img/validation.jpg') }}" class="card-img-top" alt="validation image">
                                    <div class="card-body">
                                        <h5 class="card-title">Valida tu cuenta utilizando tu INE</h5>
                                        <p class="card-text">Valida tu cuenta de forma <b>segura</b> y <b>fácil</b> por
                                            medio de tu
                                            identificación oficial INE o IFE.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>

                    </div>
                </div>
            </div>
            <!-- End Carousel -->
        </div>
        <div class="col-sm-12 col-md-7 col-lg-8 col-xl-8">
            <!-- Graphic Section -->
            <section class="row justify-content-center align-items-center">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Últimas votaciones electorales 2018</h5>

                        <!-- Pie Chart -->
                        <canvas id="pieChart" style="max-height: 400px;"></canvas>
                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                new Chart(document.querySelector('#pieChart'), {
                                    type: 'pie',
                                    data: {
                                        labels: [
                                            'MORENA',
                                            'PAN',
                                            'PRI',
                                            'Independientes',
                                            'Votos Nulos'
                                        ],
                                        datasets: [{
                                            data: [53.19, 22.27, 16.40, 5.23, 2.91],
                                            backgroundColor: [
                                                'rgb(213, 36, 33)',
                                                'rgb(52, 166, 254)',
                                                'rgb(42, 162, 60)',
                                                'rgb(175, 60, 198)',
                                                'rgb(171, 171, 171)'
                                            ],
                                            hoverOffset: 6
                                        }]
                                    }
                                });
                            });
                        </script>
                        <!-- End Pie CHart -->

                    </div>
                </div>
            </section>
            <!-- End Graphic Section -->
        </div>
    </div>
    <hr />
    <!-- End Principal Part -->

    <!-- Card Secion 2 -->
    <section>
        <div class="row justify-content-center">
            <!-- View the news -->
            <div class="card col-sm-12 col-md-6 col-lg-5 col-xl-5 mx-2">
                <div class="card-body">
                    <h5 class="card-title">Noticias</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Infórmate de lo que está pasando.</h6>
                    <p class="card-text">Ingresa a ver las noticias más relevantes del país y filtra tus búsquedas por
                        estado, medio o tipo.</p>
                    <div class="text-center">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#basicModal">
                            Ver noticias
                        </button>
                    </div>
                    <div class="modal fade" id="basicModal" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Función sin implementar</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Aún no hemos implementado esa función, sentimos mucho las molestias.
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- View the voting -->
            <div class="card col-sm-12 col-md-6 col-lg-5 col-xl-5 mx-2">
                <div class="card-body">
                    <h5 class="card-title">Votación</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Las votaciones más importantes del país.</h6>
                    <p class="card-text">Vota por tus candidatos elegidos y acerca de las propuestas de ley que
                        consideres importantes</p>
                    <div class="text-center">
                        <a class="btn btn-primary" href="{{route('votar.index')}}">Ver votaciones</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Card Section 2 -->

</x-template-principal>

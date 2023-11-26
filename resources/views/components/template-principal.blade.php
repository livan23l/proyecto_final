<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <title>VERN</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('NiceAdmin/assets/img/logo.png') }}" rel="icon" />
    <link href="{{ asset('NiceAdmin/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon" />

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('NiceAdmin/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('NiceAdmin/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('NiceAdmin/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('NiceAdmin/assets/vendor/quill/quill.snow.css') }}" rel="stylesheet" />
    <link href="{{ asset('NiceAdmin/assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet" />
    <link href="{{ asset('NiceAdmin/assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet" />
    <link href="{{ asset('NiceAdmin/assets/vendor/simple-datatables/style.css') }}" rel="stylesheet" />

    <!-- Template Main CSS File -->
    <link href="{{ asset('NiceAdmin/assets/css/style.css') }}" rel="stylesheet">

</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="/presentacion" class="logo d-flex align-items-center">
                <img src="{{ asset('NiceAdmin/assets/img/logo.png') }}" alt="">
                <span class="d-none d-lg-block">VERN</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->

    </header><!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('presentacion') ? '' : 'collapsed' }}" href="/presentacion">
                    <i class="bi bi-grid"></i>
                    <span>Principal</span>
                </a>
            </li><!-- End Principal Nav -->

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('votar.index') ? '' : 'collapsed' }}" href="/votar">
                    <i class="bi bi-file-earmark-check"></i>
                    <span>Votar</span>
                </a>
            </li><!-- End Votar Nav -->

            <li class="nav-item">
                <a class="nav-link {{request()->routeIs('candidato.*') ? '' : 'collapsed'}}" data-bs-target="#candidatos-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-people-fill"></i><span>Candidatos</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="candidatos-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="/candidato" class={{request()->routeIs('candidato.index') ? 'active' : '' }}>
                            <i class="bi bi-circle"></i><span>Principal</span>
                        </a>
                    </li>
                    <li>
                        <a href="/candidato/create" class={{request()->routeIs('candidato.create') ? 'active' : '' }}>
                            <i class="bi bi-circle active"></i><span>Crear nuevo</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Candidatos Nav -->

            <li class="nav-item">
                <a class="nav-link {{request()->routeIs('votacion.*') ? '' : 'collapsed'}}" data-bs-target="#votaciones-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-file-bar-graph"></i><span>Votaciones</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="votaciones-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="/votacion" class={{request()->routeIs('votacion.index') ? 'active' : '' }}>
                            <i class="bi bi-circle"></i><span>Principal</span>
                        </a>
                    </li>
                    <li>
                        <a href="/votacion/create" class={{request()->routeIs('votacion.create') ? 'active' : '' }}>
                            <i class="bi bi-circle active"></i><span>Crear nueva</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Votaciones Nav -->

        </ul>

    </aside><!-- End Sidebar-->

    <!-- ======= #main ======= -->
    <main id="main" class="main">

        {{ $slot }}

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="credits">
            Diseñado por <b><i>Iván Alfredo López Barrera</i></b>
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- jQuery and similar -->
    <script src="{{ asset('jquery-3.7.1.js')}}"></script>

    <!-- Vendor JS Files -->
    <script src="{{ asset('NiceAdmin/assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('NiceAdmin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('NiceAdmin/assets/vendor/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('NiceAdmin/assets/vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('NiceAdmin/assets/vendor/quill/quill.min.js') }}"></script>
    <script src="{{ asset('NiceAdmin/assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('NiceAdmin/assets/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('NiceAdmin/assets/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('NiceAdmin/assets/js/main.js') }}"></script>
</body>

</html>
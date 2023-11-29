<div>
    <!-- jQuery and similar -->
    <script src="{{ asset('jquery-3.7.1.js') }}"></script>

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

    <!-- Others -->
    <script src="{{ asset('js/quill.js') }}"></script>

    <!-- My js -->
    @if (request()->routeIs('candidato.index'))  <!-- Alertas Candidatos -->
        <script src="{{ asset('js/candidatos-index.js') }}"></script>
    @elseif (request()->routeIs('noticia.create') || request()->routeIs('noticia.edit') )  <!-- Quill -->
        <script src="{{ asset('js/noticia-form.js') }}"></script>
    @elseif (request()->routeIs('votacion.index'))  <!-- Alertas votaciones -->
        <script src="{{ asset('js/votacion-index.js') }}"></script>
    @elseif (request()->routeIs('votar.show'))  <!-- Alertas votar -->
        <script src="{{ asset('js/votar-index.js') }}"></script>
    @elseif (request()->routeIs('noticia.index'))  <!-- Alertas noticias -->
        <script src="{{ asset('js/noticia-index.js') }}"></script>
    @endif
</div>
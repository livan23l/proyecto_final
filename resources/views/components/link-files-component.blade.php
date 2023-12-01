<div>
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

    <!-- Others -->
    <link rel="preconnect" href="https://fonts.bunny.net">

    @if (request()->routeIs('profile.configuration'))
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="p3BKtV1xoyrIepgZh8MmGtzx3DrbrulXlgbkYiHF">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&amp;display=swap" rel="stylesheet">

        <!-- Scripts -->
        <link rel="preload" as="style" href="http://localhost:8000/build/assets/app-a365a1c0.css">
        <link rel="modulepreload" href="http://localhost:8000/build/assets/app-02317797.js">
        <link rel="stylesheet" href="http://localhost:8000/build/assets/app-a365a1c0.css" data-navigate-track="reload">
        <script type="module" src="http://localhost:8000/build/assets/app-02317797.js" data-navigate-track="reload"></script>
        <!-- Styles -->
        <!-- Livewire Styles -->
        <style>
            [wire\:loading],
            [wire\:loading\.delay],
            [wire\:loading\.inline-block],
            [wire\:loading\.inline],
            [wire\:loading\.block],
            [wire\:loading\.flex],
            [wire\:loading\.table],
            [wire\:loading\.grid],
            [wire\:loading\.inline-flex] {
                display: none;
            }

            [wire\:loading\.delay\.shortest],
            [wire\:loading\.delay\.shorter],
            [wire\:loading\.delay\.short],
            [wire\:loading\.delay\.long],
            [wire\:loading\.delay\.longer],
            [wire\:loading\.delay\.longest] {
                display: none;
            }

            [wire\:offline] {
                display: none;
            }

            [wire\:dirty]:not(textarea):not(input):not(select) {
                display: none;
            }

            [x-cloak] {
                display: none;
            }
        </style>
        <style>
            /* Make clicks pass-through */
            #nprogress {
                pointer-events: none;
            }

            #nprogress .bar {
                //   background: #FC70A9;
                background: #29d;

                position: fixed;
                z-index: 1031;
                top: 0;
                left: 0;

                width: 100%;
                height: 2px;
            }

            /* Fancy blur effect */
            #nprogress .peg {
                display: block;
                position: absolute;
                right: 0px;
                width: 100px;
                height: 100%;
                box-shadow: 0 0 10px #29d, 0 0 5px #29d;
                opacity: 1.0;

                -webkit-transform: rotate(3deg) translate(0px, -4px);
                -ms-transform: rotate(3deg) translate(0px, -4px);
                transform: rotate(3deg) translate(0px, -4px);
            }

            /* Remove these to get rid of the spinner */
            #nprogress .spinner {
                display: block;
                position: fixed;
                z-index: 1031;
                top: 15px;
                right: 15px;
            }

            #nprogress .spinner-icon {
                width: 18px;
                height: 18px;
                box-sizing: border-box;

                border: solid 2px transparent;
                border-top-color: #29d;
                border-left-color: #29d;
                border-radius: 50%;

                -webkit-animation: nprogress-spinner 400ms linear infinite;
                animation: nprogress-spinner 400ms linear infinite;
            }

            .nprogress-custom-parent {
                overflow: hidden;
                position: relative;
            }

            .nprogress-custom-parent #nprogress .spinner,
            .nprogress-custom-parent #nprogress .bar {
                position: absolute;
            }

            @-webkit-keyframes nprogress-spinner {
                0% {
                    -webkit-transform: rotate(0deg);
                }

                100% {
                    -webkit-transform: rotate(360deg);
                }
            }

            @keyframes nprogress-spinner {
                0% {
                    transform: rotate(0deg);
                }

                100% {
                    transform: rotate(360deg);
                }
            }
        </style>
    @endif
</div>

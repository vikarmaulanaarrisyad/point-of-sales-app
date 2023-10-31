<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} - @yield('title')</title>

    {{--  <link rel="icon" href="{{ url($setting->path_image ?? '') }}" type="image/*">  --}}

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <link rel="stylesheet" href="{{ asset('AdminLTE') }}/plugins/fontawesome-free/css/all.min.css">

    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <link rel="stylesheet"
        href="{{ asset('AdminLTE') }}/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">

    <link rel="stylesheet" href="{{ asset('AdminLTE') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">

    <link rel="stylesheet" href="{{ asset('AdminLTE') }}/plugins/jqvmap/jqvmap.min.css">


    <link rel="stylesheet" href="{{ asset('AdminLTE') }}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">

    <link rel="stylesheet" href="{{ asset('AdminLTE') }}/plugins/daterangepicker/daterangepicker.css">

    <link rel="stylesheet" href="{{ asset('AdminLTE') }}/plugins/summernote/summernote-bs4.min.css">

    <link rel="stylesheet" href="{{ asset('/AdminLTE/plugins/sweetalert2/sweetalert2.min.css') }}">


    @stack('css_vendor')

    <link rel="stylesheet" href="{{ asset('AdminLTE') }}/dist/css/adminlte.min.css?v=3.2.0">

    <style>
        .note-editor {
            margin-bottom: 0;
        }

        .note-editor.is-invalid {
            border-color: var(--danger);
        }

        .nav-sidebar .nav-header {
            font-size: .6rem;
            font-weight: bold;
            color: #888;
        }
    </style>

    @stack('css')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('AdminLTE') }}/dist/img/AdminLTELogo.png" alt="AdminLTELogo"
                height="60" width="60">
        </div>

        @include('partials.header')


        @include('partials.sidebar')

        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">@yield('title')</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                @section('breadcrumb')
                                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                @show
                            </ol>
                        </div>
                    </div>
                </div>
            </div>


            <section class="content">
                <div class="container-fluid">

                    @yield('content')

                </div>
            </section>

        </div>
        @include('partials.footer')

    </div>


    <script src="{{ asset('AdminLTE') }}/plugins/jquery/jquery.min.js"></script>

    <script src="{{ asset('AdminLTE') }}/plugins/jquery-ui/jquery-ui.min.js"></script>

    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>

    <script src="{{ asset('AdminLTE') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="{{ asset('AdminLTE') }}/plugins/chart.js/Chart.min.js"></script>

    <script src="{{ asset('AdminLTE') }}/plugins/sparklines/sparkline.js"></script>

    <script src="{{ asset('AdminLTE') }}/plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="{{ asset('AdminLTE') }}/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>

    <script src="{{ asset('AdminLTE') }}/plugins/jquery-knob/jquery.knob.min.js"></script>

    <script src="{{ asset('AdminLTE') }}/plugins/moment/moment.min.js"></script>
    <script src="{{ asset('AdminLTE') }}/plugins/daterangepicker/daterangepicker.js"></script>

    <script src="{{ asset('AdminLTE') }}/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>

    <script src="{{ asset('AdminLTE') }}/plugins/summernote/summernote-bs4.min.js"></script>

    <script src="{{ asset('AdminLTE') }}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>

    <script src="{{ asset('/AdminLTE/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>

    @stack('scripts_vendor')

    <script src="{{ asset('AdminLTE') }}/dist/js/adminlte.js?v=3.2.0"></script>

    <script src="{{ asset('AdminLTE') }}/dist/js/demo.js"></script>

    <script src="{{ asset('AdminLTE') }}/dist/js/pages/dashboard.js"></script>

    <script src="{{ asset('/js/custome.js') }}"></script>

    @stack('scripts')
</body>

</html>

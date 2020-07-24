<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- Laravel Mix - CSS File --}}
    <link rel="stylesheet" href="{{ asset('modules/painel/css/app.min.css') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

    @include('painel::layouts.css')

</head>

<body id="page-top" class="sidebar-toggled">


    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">
        <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
            <i class="fas fa-bars" style="font-size: 20px"></i>
        </button>

        <a class="navbar-brand" href="{{ route('painel.index') }}">

            <span class="d-lg-inline d-sm-none d-none" style="padding: 5px">{{ config('app.name', 'Laravel') }}</span>
        </a>
        <ul class="navbar-nav ml-auto form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-user-circle fa-fw"></i>
                    {{Auth::user()->name}}
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="#">Configurações</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
                </div>
            </li>
        </ul>

    </nav>
    <div id="wrapper">
        @include('painel::layouts.sidebar')

        <div id="content-wrapper">
            <div class="container-fluid">
                @include('sweetalert::alert')

                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif


                @yield('content')
            </div>
        </div>
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Esta de saída?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Clique em Logout para finalizar a sessão</div>
                    <div class="modal-footer">
                        <form id="logout-form" action="{{ route('painel.auth.logout') }}" method="POST">
                            @csrf
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

                            <button class="btn btn-primary" type="submit">Logout</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('modules/painel/js/app.js') }}"></script>
    @include('painel::layouts.scripts')

</body>

</html>

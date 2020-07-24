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

<body id="page-top" class="bg-dark" class="sidebar-toggled">
    <div id="wrapper">
        <div id="content-wrapper">
            <div class="container">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
                @endif
                @if (session('warning'))
                <div class="alert alert-warning">
                    {{ session('warning') }}
                </div>
                @endif
                @if (session('danger'))
                <div class="alert alert-danger">
                    {{ session('danger') }}
                </div>
                @endif
                @yield('content')
            </div>
        </div>
    </div>
    <script src="{{ asset('modules/painel/js/app.js') }}"></script>
    @include('painel::layouts.scripts')

</body>

</html>

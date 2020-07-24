@extends('painel::layouts.auth-master')

@section('content')

<div class="card card-login mx-auto mt-5">
    <div class="card-header">
        <div class="container">
            <img src="{{asset('img/maillogo.png')}}" class="mx-auto d-block" width="180px">
        </div>

    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('painel.auth.login') }}">
            @csrf
            <div class="form-group">
                <div class="form-label-group">
                    <input id="userprincipalname" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus>


                    @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('username') }}</strong>
                    </span>
                    @endif
                    <label for="userprincipalname">Usuário</label>
                </div>
            </div>
            <div class="form-group">
                <div class="form-label-group">
                    <input id="password" type="password"
                        class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                        required>

                    @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                    <label for="inputPassword">Senha</label>
                </div>
            </div>
            <div class="form-group">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" value="remember-me">
                        Lembrar
                    </label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-block">
                Login
            </button>
        </form>

    </div>
</div>

@endsection

@extends('layouts.app', ['class' => 'login-page', 'page' => __('Login Page'), 'contentClass' => 'login-page'])

@section('content')
<!-- Titulo del login -->
<div class="col-md-10 text-center ml-auto mr-auto">
    <h3 class="mb-5">Logeate para ver todos los contactos.</h3>
</div>
<!-- Formulario para el login -->
<div class="col-lg-4 col-md-6 ml-auto mr-auto">
    <form class="form" method="post" action="{{ url('login') }}">
        @csrf
        <div class="card card-login card-white">
            <!-- Header de la tarjeta -->
            <div class="card-header">
                <img src="{{ asset('black') }}/img/card-primary.png" alt="">
                <h1 class="card-title">{{ __('Log in') }}</h1>
            </div>
            <!-- Cuerpo de la tarjeta  -->
            <div class="card-body">
                <p class="text-dark mb-2">Ingresa con el correo <strong>admin@black.com</strong> y la contraseña <strong>secret</strong></p>
                <div class="input-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="tim-icons icon-email-85"></i>
                        </div>
                    </div>
                    <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}">
                    @include('alerts.feedback', ['field' => 'email'])
                </div>
                <div class="input-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="tim-icons icon-lock-circle"></i>
                        </div>
                    </div>
                    <input type="password" placeholder="{{ __('Contraseña') }}" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}">
                    @include('alerts.feedback', ['field' => 'password'])
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" href="{{ url('/Contactos')}}" class="btn btn-primary btn-lg btn-block mb-3">{{ __('Acceder') }}</button>
                <div class="pull-left">
                    <h6>
                        <a href="{{ route('register') }}" class="link footer-link">{{ __('Crear Cuenta') }}</a>
                    </h6>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
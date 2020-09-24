@extends('layouts.app', ['class' => 'register-page', 'page' => __('Register Page'), 'contentClass' => 'register-page'])

@section('content')
<div class="row">
    <!-- Decoradores para el form del registro -->
    <div class="col-md-5 ml-auto">
        <div class="info-area info-horizontal mt-5">
            <div class="icon icon-warning">
                <i class="tim-icons icon-wifi"></i>
            </div>
            <div class="description">
                <h3 class="info-title">{{ __('Marketing') }}</h3>
                <p class="description">
                    {{ __('Creamos una gran red de contactos para mantenerte actualizado.') }}
                </p>
            </div>
        </div>
        <div class="info-area info-horizontal">
            <div class="icon icon-primary">
                <i class="tim-icons icon-triangle-right-17"></i>
            </div>
            <div class="description">
                <h3 class="info-title">{{ __('Codificado en Laravel') }}</h3>
                <p class="description">
                    {{ __('Sitio desarrollado con HTML5 usando el framework Laravel usando PHP tanto para el diseño front como el back.') }}
                </p>
            </div>
        </div>
        <div class="info-area info-horizontal">
            <div class="icon icon-info">
                <i class="tim-icons icon-trophy"></i>
            </div>
            <div class="description">
                <h3 class="info-title">{{ __('Dedicacion') }}</h3>
                <p class="description">
                    {{ __('Mas de 24 horas dedicadas completamente a la creacion del proyecto.') }}
                </p>
            </div>
        </div>
    </div>
    <!-- Form del registro -->
    <div class="col-md-7 mr-auto">
        <div class="card card-register card-white">
            <!-- Header de la tarjeta -->
            <div class="card-header">
                <img class="card-img" src="{{ asset('black') }}/img/card-primary.png" alt="">
                <h4 class="card-title">{{ __('Registro') }}</h4>
            </div>
            <!-- Form con metodo POST para validar la autenticacion en la base de datos  -->
            <form class="form" method="post" action="{{ route('register') }}">
                @csrf
                <!-- Cuerpo de la tarjeta -->
                <div class="card-body">
                    <div class="input-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="tim-icons icon-single-02"></i>
                            </div>
                        </div>
                        <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Nombre') }}">
                        @include('alerts.feedback', ['field' => 'name'])
                    </div>
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
                        <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('Contraseña') }}">
                        @include('alerts.feedback', ['field' => 'password'])
                    </div>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="tim-icons icon-lock-circle"></i>
                            </div>
                        </div>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="{{ __('Confirmar contraseña') }}">
                    </div>
                    <div class="form-check text-left">
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox">
                            <span class="form-check-sign"></span>
                            {{ __('Acepto los') }}
                            <a href="#">{{ __('terminos y condiciones') }}</a>.
                        </label>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-round btn-lg">{{ __('Registrame!') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
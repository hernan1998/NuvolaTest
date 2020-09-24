<!-- Se muestra cuando el usuario no esta logeado -->
<nav class="navbar navbar-expand-lg navbar-absolute navbar-transparent fixed-top">
    <div class="container-fluid">
        <div class="navbar-wrapper">
            <div class="navbar-toggle d-inline">
                <button type="button" class="navbar-toggler">
                    <span class="navbar-toggler-bar bar1"></span>
                    <span class="navbar-toggler-bar bar2"></span>
                    <span class="navbar-toggler-bar bar3"></span>
                </button>
            </div>
            <a class="navbar-brand" href="#">{{ 'NUVOLA' }}</a>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
        </button>
        <div class="collapse navbar-collapse" id="navigation">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <!-- Boton para regresar a la pagina principal -->
                    <a href="{{ url('/') }}" class="nav-link text-primary">
                        <i class="tim-icons icon-minimal-left"></i> {{ __('Atras') }}
                    </a>
                </li>
                <li class="nav-item ">
                    <!-- Boton para ir a la vista de registro -->
                    <a href="{{ route('register') }}" class="nav-link">
                        <i class="tim-icons icon-laptop"></i> {{ __('Registrar') }}
                    </a>
                </li>
                <li class="nav-item ">
                    <!-- Boton para ir a la vista de Login -->
                    <a href="{{ route('login') }}" class="nav-link">
                        <i class="tim-icons icon-single-02"></i> {{ __('Login') }}
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
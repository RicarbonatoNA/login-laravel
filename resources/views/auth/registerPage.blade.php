@extends('layout.layout')
@if ($message = Session::get('error'))
    <div class="alert alert-danger"><span>{{ $message }}</span></div>
@elseif($message = Session::get('success'))
    <div class="alert alert-success">{{ $message }}</div>
@endif

<head>

</head>
<nav class="navbar bg-success">
    <div class="container-fluid">
        <span class="navbar-brand mb-0 h1">Registrarse</span>
    </div>
</nav>
<div class="container">
    <div class="row mt-3">
        <div class="col-md-6 offset-md-3"">
            <div class="card">
                <div class="card-body">
                    <form id="demo-form" method="post" action="{{ url('register') }}">
                        @csrf
                        <div>
                            <label class="form-label">Nombre de usuario</label>
                            <input class="form-control my-3" type="text" name="name"
                                placeholder="Escribe tu nombre de usuario">
                        </div>
                        <div>
                            <label class="form-label">Correo</label>
                            <input class="form-control my-3" type="email" name="email"
                                placeholder="Escribe tu correo electronico">
                        </div>
                        <div>
                            <label class="form-label">Contraseña</label>
                            <input class="form-control mt-3" type="password" name="password"
                                placeholder="Escribe tu contraseña">
                        </div>
                        <button class="g-recaptcha btn btn-success"
                        data-sitekey="6Les54gpAAAAAEfXraux331noDksMHtg1uG4KJxT"
                        data-callback='onSubmit'
                        data-action='submit'>Registrarme</button>
                    </form>
                    <a href="/login" class="text-center">Iniciar Sesión</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script>
    function onSubmit(token) {
        document.getElementById("demo-form").submit();
    }
</script>



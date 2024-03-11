@extends('layout.layout')
@if ($message = Session::get('error'))
    <div class="alert alert-danger"><span>{{ $message }}</span></div>
@elseif($message = Session::get('success'))
    <div class="alert alert-success">{{ $message }}</div>
@endif
<nav class="navbar bg-tertiary bg-primary">
    <div class="container-fluid">
        <span class="navbar-brand mb-0 h1">Iniciar Sesión</span>
    </div>
</nav>
<div class="container">
    <div class="row mt-3">
        <div class="col-md-6 offset-md-3"">
            <div class="card">
                <div class="card-body">
                    <form id="demo-form" method="post" action="{{ url('session') }}">
                        @csrf
                        <div>
                            <label class="form-label">Correo</label>
                            <input class="form-control my-3" type="email" name="email" placeholder="Escribe tu correo">
                        </div>
                        <div>
                            <label class="form-label">Contraseña</label>
                            <input class="form-control mt-3" type="password" name="password" placeholder="Escribe tu contraseña">
                        </div>
                        <button class="g-recaptcha btn btn-primary"
                        data-sitekey="6LcvcpMpAAAAAAieJaUTKx7qBTzO9aJ_8nL3LX_e"
                        data-callback='onSubmit'
                        data-action='submit'>Iniciar Sesión</button>
                    </form>
                    <a href="/signUp" class="text-center">Registrarme</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://www.google.com/recaptcha/api.js"></script>
<script>
    function onSubmit(token) {
      document.getElementById("demo-form").submit();
    }
</script>

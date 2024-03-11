@extends('layout.layout')
@if ($message = Session::get('error'))
    <div class="alert alert-danger"><span>{{ $message }}</span></div>
@elseif($message = Session::get('success'))
    <div class="alert alert-success">{{ $message }}</div>
@endif

<div class="container">
    <div class="row mt-3">
        <div class="col-md-6 offset-md-3"">
            <div class="card">
                <div class="card-header bg-dark text-white">verificar codigo</div>
                <div class="card-body">
                    <form id="demo-form" method="post" action="{{ url('confirmCode') }}">
                        @csrf
                        <div>
                            <label class="form-label">codigo</label>
                            <input class="form-control my-3" type="text" name="codigo" placeholder="codigo">
                        </div>
                        <button class="g-recaptcha btn btn-primary my-3" data-sitekey="6LcvcpMpAAAAAAieJaUTKx7qBTzO9aJ_8nL3LX_e"
                            data-callback='onSubmit' data-action='submit'>verificar</button>
                    </form>
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

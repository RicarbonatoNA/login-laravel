@extends('layout.layout')
@if ($message = Session::get('error'))
    <div class="alert alert-danger"><span>{{ $message }}</span></div>
@elseif($message = Session::get('success'))
    <div class="alert alert-success">{{ $message }}</div>
@endif

<div class="card">
    <div class="card-body">
        Bienvenido, Guapx @if (Auth::user()->rol_id == 1)
            administrador
            @else
            mortal
        @endif
    </div>
    <a href="{{url('/logout')}}" class="btn btn-warning my-3">Cerrar sesión</a>
</div>

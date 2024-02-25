@extends('layout.layout')


<div class="container">
    <h1>BIENVENID@:{{$name}}</h1>
    <p>Ingresa el siguiente codigo en la siguiente ruta:<b>{{$codigo}}</b></p><br>
    <p>El cual vencera dentro de 5 minutos</p>
    <a href="{{$url}}">Verificar codigo</a>
</div>

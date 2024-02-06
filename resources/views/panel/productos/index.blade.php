@extends('adminlte::page')

@section('content_header')
    <a class="btn btn-secondary float-right" href="{{route('panel.products.create')}}">Nuevo producto</a>
    <h1>Listado de productos</h1>
@stop

@section('content')

    @if (session('info'))
    <div class="alert alert-success">
        <strong>{{session('info')}}</strong>
    </div>
    @endif
    
    @livewire('panel.products-index')
@stop
@extends('adminlte::page')

@section('content_header')
    <a class="btn btn-secondary float-right" href="{{route('panel.catalogues.create')}}">Nuevo catálogo</a>
    <h1>Listado de catálogos</h1>
@stop

@section('content')

    @if (session('info'))
    <div class="alert alert-success">
        <strong>{{session('info')}}</strong>
    </div>
    @endif
    
    @livewire('panel.catalogues-index')
@stop
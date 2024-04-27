@extends('adminlte::page')

@section('title', 'Productos')

@section('content_header')

    <a href="{{ route('panel.products.index') }}" class="btn btn-secondary float-right">Volver</a>

    <h1>Importar Productos</h1>
@stop

@section('content')

@livewire('panel.productos.products-import')
@stop

@section('css')

@stop
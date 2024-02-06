@extends('adminlte::page')

@section('content_header')
   
    <a class="btn btn-secondary float-right" data-toggle="tooltip" title="Nuevo producto"
    data-container=".content" href="{{ route('panel.products.create') }}">
        <i class="fas fa-plus-circle"></i>
    </a>
    <a class="btn btn-secondary mr-3 float-right" data-toggle="tooltip" title="Importar productos"
    data-container=".content" href="{{ route('panel.productos.importar')}}">
        <i class="fas fa-file-import"></i>
    </a> 
    <h1>Listado de productos</h1>
@stop

@section('content')

    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{ session('info') }}</strong>
        </div>
    @endif

    @livewire('panel.products-index')
@stop


@section('js')

    <script>

        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });

    </script>

@stop
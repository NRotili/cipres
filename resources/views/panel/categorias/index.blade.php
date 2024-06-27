@extends('adminlte::page')

@section('content_header')
    <h1>Listado de categorías</h1>
@stop

@section('content')

    @livewire('panel.categorias.categorias-index')

@stop


@section('js')

    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();


        });
    </script>

@stop

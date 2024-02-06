@extends('adminlte::page')

{{-- @section('title', 'Cipres') --}}

@section('content_header')
    <h1>Cipres</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12 col-md-6">
            <x-adminlte-small-box title="{{ $cantProduct }}" text="PRODUCTOS" icon="fas fa-list text-dark" theme="teal"
                url="{{ route('panel.products.index') }}" url-text="+ info" />
        </div>
        <div class="col-12 col-md-6">
            <x-adminlte-small-box title="{{ $cantCata + 1 }}" text="CATÁLOGOS" icon="fas fa-book-open text-dark"
                theme="teal" url="{{ route('panel.catalogues.index') }}" url-text="+ info" />
        </div>
    </div>


@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')

@stop

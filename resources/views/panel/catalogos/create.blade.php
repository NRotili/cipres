@extends('adminlte::page')

{{-- @section('title', 'Animalium') --}}

@section('content_header')
    <h1>Crear nuevo catálogo</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => 'panel.catalogues.store', 'autocomplete' => 'off']) !!}

            @include('panel.catalogos.partials.form')

            {!! Form::submit('Crear catálogo', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@stop
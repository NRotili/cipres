@extends('adminlte::page')

{{-- @section('title', 'Animalium') --}}

@section('content_header')
    <h1>Editar catálogo</h1>
@stop

@section('content')

    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{session('info')}}</strong>
        </div>
    @endif
    
    <div class="card">
        <div class="card-body">
            {!! Form::model($catalogue,['route' => ['panel.catalogues.update', $catalogue],'autocomplete'=> 'off', 'method'=>'put']) !!}

                @include('panel.catalogos.partials.form')

                {!! Form::submit('Actualizar catálogo', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@stop
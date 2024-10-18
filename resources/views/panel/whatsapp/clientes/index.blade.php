@extends('adminlte::page')

@section('content_header')
    <a class="btn btn-secondary float-right" href="{{ route('panel.wsp.clientes.create') }}">Nuevo cliente</a>
    <h1>Whatsapp - Clientes</h1>
@stop

@section('content')

    @livewire('panel.whatsapp.clientes.clientes-index')


@stop   

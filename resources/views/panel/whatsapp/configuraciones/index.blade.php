@extends('adminlte::page')

@section('content_header')
    <a class="btn btn-secondary float-right" data-toggle="modal" data-target="#configModal" wire:click="nuevoDato()">Nuevo dato</a>
    <h1>Whatsapp - Datos configurables</h1>
@stop

@section('content')

   @livewire('panel.whatsapp.configuraciones.configuraciones-index')

@stop

@extends('adminlte::page')

@section('content_header')
    <h1>Whatsapp - Chats</h1>
@stop

@section('content')

    @livewire('panel.whatsapp.chats.chats-index')

@stop   

@section('js')

    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

@stop
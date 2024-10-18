@extends('adminlte::page')

@section('content_header')
    {{-- button sin href with logo qr --}}

@stop

@section('css')
    <style>
        .led {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background-color: #ccc;
            /* Por defecto, un color gris */
        }

        .led-green {
            background-color: #28a745;
            /* Verde para ONLINE */
        }

        .led-yellow {
            background-color: #ffc107;
            /* Amarillo para ESCANEAR QR */
        }

        .led-red {
            background-color: #dc3545;
            /* Rojo para ERROR */
        }
    </style>
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

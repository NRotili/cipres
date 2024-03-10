@extends('adminlte::page')

@section('content_header')
    <a class="btn btn-secondary float-right" href="{{route('panel.catalogues.create')}}">Nuevo catálogo</a>
    <h1>Listado de catálogos</h1>
@stop

@section('content')

    @if (session('info'))
    <div class="alert alert-success">
        <strong>{{session('info')}}</strong>
    </div>
    @endif
    
    {{-- Include livewire panel.catalogues-index --}}
    @livewire('panel.catalogues-index')
@stop

@section('js')
<script>
    // Función para copiar la URL al portapapeles
    function copyToClipboard(event) {
        // Obtiene la URL del botón en el que se hizo clic
        var url = event.target.getAttribute('data-url');

        // Crea un elemento de texto temporal
        var tempInput = document.createElement("input");
        tempInput.value = url;

        // Agrega el elemento temporal al DOM
        document.body.appendChild(tempInput);

        // Selecciona y copia el contenido del elemento temporal
        tempInput.select();
        document.execCommand("copy");

        // Elimina el elemento temporal del DOM
        document.body.removeChild(tempInput);

        // Muestra una notificación o mensaje para indicar que se copió la URL con php-flasher/flasher-toastr-larave
        Swal.fire({
            position: 'top-end',
            icon: "success",
            title: 'URL copiada al portapapeles',
            showConfirmButton: false,
            timer: 600
        });
        // alert("URL copiada al portapapeles: " + url);
    }

    // Obtener todos los botones con la clase "copy-url-button" y agregar un evento de clic a cada uno
    var copyButtons = document.querySelectorAll('.copy-url-button');
    copyButtons.forEach(function(button) {
        button.addEventListener('click', copyToClipboard);
    });
</script>
@stop

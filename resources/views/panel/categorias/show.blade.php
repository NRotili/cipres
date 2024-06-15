@extends('adminlte::page')

@section('content_header')
    <h1>Datos de categoría: <strong>{{ $categoria->nombre }}</strong></h1>
@stop

@section('content')

    <div class="card">
        <div class="card-body">
            <div class="row">

                <div class="col col-md-6 col-sm-12">

                    <x-adminlte-info-box title="Nombre" text="{{ $categoria->nombre }}" icon="fas fa-lg fa-list"
                        icon-theme="purple" />

                </div>
                <div class="col col-md-6 col-sm-12">
                    <x-adminlte-info-box title="Cant. Productos" text="{{ $categoria->productos->count() }}"
                        icon="fas fa-lg fa-box" icon-theme="purple" />
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h5>Productos de la categoría</h5>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Precio venta 2</th>
                        <th>Precio venta 3</th>
                        <th>Ult. Modificación</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categoria->productos as $producto)
                        <tr>
                            <td>{{ $producto->id }}</td>
                            <td>{{ $producto->nombre }}</td>
                            <td>{{ $producto->precioventa2 }}</td>
                            <td>{{ $producto->precioventa3 }}</td>
                            <td>{{ $producto->updated_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


@stop


@section('js')

    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();


        });
    </script>

@stop

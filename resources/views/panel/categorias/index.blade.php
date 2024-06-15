@extends('adminlte::page')

@section('content_header')
    <h1>Listado de categorías</h1>
@stop

@section('content')

    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{ session('info') }}</strong>
        </div>
    @endif

    <div class="card">
        
        @if ($categorias->count())
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Cant. Productos</th>
                            <th>Productos Visibles</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categorias as $categoria)
                            <tr>
                                <td>{{ $categoria->id }}</td>
                                <td>{{ $categoria->nombre }}</td>
                                <td>{{ $categoria->productos->count() }}</td>
                                <td>{{ $categoria->productos->where('estado', 1)->count() }}</td>
                                {{-- Show categorie --}}
                                <td width="10px">
                                    <a href="{{ route('panel.categorias.show', $categoria) }}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Ver">
                                        <i class="fas fa-eye
                                        "></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
          
        @else
            <div class="card-body">
                <strong>No hay registros</strong>
            </div>
            
        @endif
    </div>


@stop


@section('js')

    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();


        });
    </script>

@stop

@extends('adminlte::page')

@section('title', 'Productos')

@section('content_header')

    <a href="{{ route('panel.products.index') }}" class="btn btn-secondary float-right">Volver</a>

    <h1>Importar Productos</h1>
@stop

@section('content')

    {{-- Instructions to import --}}

    <div class="card">
        <div class="card-body">
            <div class="col col-sm-12 col-md-12 alert alert-info">

                <p>Por favor siga las siguientes instrucciones para importar productos desde un archivo Excel:</p>

                <ol>
                    <li>Descargue el archivo de ejemplo haciendo click en el botón "Descargar".</li>
                    <li>Complete el archivo con los datos de los productos a importar.</li>

                    <li>El archivo debe tener el siguiente formato respetando cada item como si fuese una columna:</li>

                    {{-- Primer columna, código --}}
                    <ul>
                        <li>
                            <p><strong>Código</strong> - Código del producto. Obligatorio. No puede estar repetido.
                                Alfanumérico.</p>
                        </li>
                        {{-- Segunda columna, nombre --}}
                        <li>
                            <p><strong>Nombre</strong> - Nombre del producto. Obligatorio. Alfanumérico.</p>
                        </li>
                        {{-- Tercera columna, cantidad --}}
                        <li>
                            <p><strong>Cantidad</strong> - Cantidad del producto. Alfanumérico.</p>
                        </li>
                        {{-- Cuarta columna, precio costo --}}
                        <li>
                            <p><strong>Precio Costo</strong> - Precio de costo del producto. Obligatorio. Numérico.
                                Utilizar . (punto) para decimales.</p>
                        </li>
                        {{-- Quinta columna, IVA --}}
                        <li>
                            <p><strong>IVA</strong> - IVA del producto. Obligatorio. Numérico. Ej: 0 (exento), 10.5
                                (10,5%), 21 (21%).</p>
                        {{-- Sexta columna, precio Lista --}}
                        <li>
                            <p><strong>Precio Lista</strong> - Precio de lista del producto. Obligatorio. Numérico.
                                Utilizar . (punto) para decimales.</p>
                        </li>

                        {{-- Octava columna, stock --}}
                        <li>
                            <p><strong>Stock</strong> - Stock del producto. Obligatorio. Numérico.</p>
                        </li>
                        {{-- Novena columna, estado --}}
                        <li>
                            <p><strong>Estado</strong> - Estado del producto. Obligatorio. Numérico. Valores
                                posibles: 1 (publicado), 0 (sin publicar).</p>
                        </li>
                    </ul>
                    <li>Una vez completado el archivo, haga click en el botón "Importar".</li>
                </ol>

                <strong>Al momento de importar productos, si existen códigos que <u>NO</u> se encuentran registrados en la base de datos, los mismos se agregarán como productos nuevos. Si existen códigos que ya se encuentran registrados en la base de datos, los mismos se actualizarán con los datos del archivo importado, exceptuando el stock.
                </strong>
            </div>
            {{-- ATTENTION --}}
            <div class="alert alert-danger">
                <p><strong>ATENCIÓN!</strong> El archivo debe tener el formato indicado, de lo contrario no se
                    importará correctamente.</p></div>

                    
        </div>
    </div>

    {{-- Form to import --}}
    <div class="card">
        <div class="card-body">
            <form action="" method="post" enctype="multipart/form-data">

                @csrf
                <div class="form-group">
                    <label for="file">Importar Productos</label>
                    <x-adminlte-input-file name="file" igroup-size="sm" placeholder="Selecciona el archivo...">
                        <x-slot name="prependSlot">
                            <div class="input-group-text bg-lightblue">
                                <i class="fas fa-upload"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input-file>
                </div>
                {{-- show errors --}}
               
                <button type="submit" class="btn btn-primary">Importar</button>
        
            </form>
        </div>
    </div>
    
@stop

@section('css')

@stop
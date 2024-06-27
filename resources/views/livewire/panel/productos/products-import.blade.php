<div>
    @section('plugins.BsCustomFileInput', true)
    {{-- @section('plugins.KrajeeFileinput', true) --}}

    {{-- Instructions to import --}}

    <div class="card">
        <div class="card-body">
            <div class="col col-sm-12 col-md-12 alert alert-info">

                <p>Por favor siga las siguientes instrucciones para importar productos desde un archivo Excel:</p>

                <ol>

                    <li>El archivo debe tener las siguientes columnas obligatorias (si existen más, no se utilizarán), donde la primer fila debe contener los siguientes campos como si fuera el título de la columna:</li>

                    <ul>
                        <li>
                            <p><strong>nombreproducto</strong> - Nombre del producto. Alfanumérico. Obligatorio.</p>
                        </li>
                        <li>
                            <p><strong>precioventa2</strong> - Precio revendedor. Decimal. Utilizar . (punto) para decimales. Obligatorio.</p>
                        </li>
                        <li>
                            <p><strong>precioventa3</strong> - Precio consumidor final. Decimal. Utilizar . (punto) para decimales. Obligatorio.</p>
                        </li>
                        <li>
                            <p><strong>codigoproducto</strong> - </p>
                        </li>
                        <li>
                            <p><strong>nombrerubro</strong> - </p>
                        </li>

                    </ul>
                    <li>Una vez completado el archivo, haga click en el botón "Importar".</li>
                </ol>

                <strong>Al momento de importar productos, si existen códigos que <u>NO</u> se encuentran registrados en la base de datos, los mismos se agregarán como productos nuevos. Si existen códigos que ya se encuentran registrados en la base de datos, los mismos se actualizarán con los datos del archivo importado.
                </strong>
            </div>
            {{-- ATTENTION --}}
            <div class="alert alger">
                <p><strong>ATENCIÓN!</strong> El archivo debe tener el formato indicado, de lo contrario no se
                    importará correctamente.</p></div>

                    
        </div>
    </div>

    {{-- Form to import --}}
    <div class="card">
        <div class="card-body">
            <form wire:submit="importarproductos">

                @csrf
                <div class="form-group">
                    <label for="file">Importar Productos</label>
                    {{-- <x-adminlte-input-file-krajee name="kifBasic"/> --}}
                    {{-- <x-adminlte-input-file wire:model="file"  disable-feedback name="file"/> --}}

                    <x-adminlte-input-file wire:model.lazy="file" name="file" igroup-size="sm" disable-feedback legend="Buscar">
                        <x-slot name="prependSlot">
                            <div class="input-group-text bg-lightblue">
                                <i class="fas fa-upload"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input-file>
                   
                    {{-- <x-adminlte-input-file wire.ignore wire:model.blur="file" name="file" igroup-size="sm" disable-feedback legend="Buscar">
                        <x-slot name="prependSlot">
                            <div class="input-group-text bg-lightblue">
                                <i class="fas fa-upload"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input-file> --}}
                </div>
                {{-- show errors --}}
               
                <button type="submit" class="btn btn-primary">Importar</button>

                
        
            </form>
        </div>
    </div>
    
</div>

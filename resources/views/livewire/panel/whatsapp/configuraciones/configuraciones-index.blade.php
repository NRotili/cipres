<div>
    <div class="card">
        @if ($config->count())
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Valor</th>
                            <th width="10px">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($config as $conf)
                            <tr>
                                <td>{{ $conf->nombre }}</td>
                                <td>{{ $conf->valor }}</td>
                                <td>                         
                                    <button wire:click="editarDato({{ $conf }})" class="btn btn-info btn-sm"
                                        data-toggle="modal" data-target="#configModal">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

            <div class="card-footer">
                {{ $config->links() }}
            </div>
        @else
            <div class="card-body">
                <strong>No hay registros</strong>
            </div>

        @endif

    </div>

    <x-adminlte-modal wire:ignore.self id="configModal" title="Configuraciones">
        <div>
            <div class="row">

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="descripcion">Nombre</label>
                        <input type="text" wire:model.defer="nombre" class="form-control" id="descripcion">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="valor">Valor</label>
                        <textarea class="form-control" id="valor" wire:model.defer="valor" rows="8" cols="50">
                        </textarea>
                    </div> 
                </div>

            </div>
            <x-slot name="footerSlot">
                <x-adminlte-button class="mr-auto" wire:click="guardarConfig()" data-dismiss="modal" theme="success"
                    label="Guardar" />
                <x-adminlte-button theme="danger" label="Cerrar" data-dismiss="modal" />
            </x-slot>
        </div>
    </x-adminlte-modal>

</div>

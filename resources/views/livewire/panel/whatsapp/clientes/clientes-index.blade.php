<div>
    <div class="card">
        <div class="card-header">
            <div class="form-row">
                <div class="form-group col-md-2">

                    <label for="nombre">Filtrar por nombre</label>
                    <input id="nombre" wire:model.live="nombre" type="text" class="form-control"
                        placeholder="Buscar por nombre" autocomplete="off">

                </div>
                <div class="form-group col-md-2">

                    <label for="apellido">Filtrar por apellido</label>
                    <input id="apellido" wire:model.live="apellido" type="text" class="form-control"
                        placeholder="Buscar por apellido" autocomplete="off">
                </div>

                <div class="form-group col-md-2">

                    <label for="telefono">Filtrar por telefono</label>
                    <input id="telefono" wire:model.live="telefono" type="text" class="form-control"
                        placeholder="Buscar por telefono" autocomplete="off">
                </div>

                <div class="form-group
                    col-md-4">
                    <label for="email">Filtrar por email</label>
                    <input id="email" wire:model.live="email" type="text" class="form-control"
                        placeholder="Buscar por email" autocomplete="off">
                </div>


                {{-- Cant por página --}}
                <div class="form-group col-md-2">
                    <label for="perPage">Cant. por página</label>
                    <select wire:model.live="cantPagina" class="form-control" id="perPage">
                        <option value="5">5</option>
                        <option selected value="10">10</option>
                        <option value="15">15</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>


            </div>
        </div>


        @if ($clientes->count())



            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Telefono</th>
                                <th>Email</th>
                                <th>Localidad</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($clientes as $cliente)
                                <tr>
                                    <td>{{ $cliente->nombre }}</td>
                                    <td>{{ $cliente->apellido }}</td>
                                    <td>{{ $cliente->telefono }}</td>
                                    <td>{{ $cliente->email }}</td>
                                    <td>{{ $cliente->localidad }}</td>
                                    <td width="10px">

                                        <div class="btn-group">

                                            @if ($cliente->blacklist)
                                                <button wire:loading.attr="disabled"
                                                    wire:click="blacklist({{ $cliente }})"
                                                    class="btn btn-warning btn-sm">
                                                    <i class="fas fa-check-circle"></i>
                                                </button>
                                            @else
                                                <button wire:loading.attr="disabled"
                                                    wire:click="blacklist({{ $cliente }})"
                                                    class="btn btn-warning btn-sm">
                                                    <i class="fas fa-user-slash"></i>
                                                </button>

                                                {{-- stopBot --}}
                                                <button wire:loading.attr="disabled"
                                                    wire:click="stopBot({{ $cliente }})"
                                                    class="btn btn-danger btn-sm">
                                                    <i class="fas fa-pause"></i>
                                                </button>

                                                {{-- startBot --}}
                                                <button wire:loading.attr="disabled"
                                                    wire:click="startBot({{ $cliente }})"
                                                    class="btn btn-success btn-sm">
                                                    <i class="fas fa-play"></i>
                                                </button>
                                            @endif



                                            {{-- <button wire:click="showmore({{ $cliente->id }})"
                                                class="btn btn-primary btn-sm" data-toggle="modal"
                                                data-target="#clienteModal">
                                                <i class="fas fa-info"></i>
                                            </button> --}}

                                            {{-- <button wire:click="edit({{ $cliente->id }})" class="btn btn-info btn-sm"
                                                data-toggle="modal" data-target="#clienteModal">
                                                <i class="fas fa-edit"></i>
                                            </button> --}}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card-footer">
                {{ $clientes->links() }}
            </div>
        @else
            <div class="card-body">
                <strong>No hay registros</strong>
            </div>

        @endif

    </div>
</div>

<div>
    <div class="card">
        <div class="card-header">
            <div class="form-row">

                <div class="form-group col-md-3">

                    <label for="telefono">Filtrar por teléfono</label>
                    <input id="telefono" wire:model.live="telefono" type="text" class="form-control"
                        placeholder="Buscar por telefono" autocomplete="off">
                </div>

                <div class="form-group
                    col-md-3">
                    <label for="email">Filtrar por tipo</label>
                    <select wire:model.live="tipo" class="form-control" id="tipo">
                        <option value="">Todos</option>
                        <option value="Empresa">Empresa</option>
                        <option value="Cliente no registrado">No Registrado</option>
                        <option value="Revendedor - Aromatización">Revendedor - Aromatización</option>
                        <option value="Revendedor - General">Revendedor - Gral</option>
                    </select>
                </div>

                <div class="form-group
                    col-md-3">
                    <label for="status">Filtrar por estado</label>
                    <select wire:model.live="status" class="form-control" id="status">
                        <option value="">Todos</option>
                        <option value="1">Sin responder</option>
                        <option value="-1">Atendidos</option>
                    </select>
                </div>


                {{-- Cant por página --}}
                <div class="form-group col-md-3">
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


        @if ($chats->count())



            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Telefono</th>
                            <th>Tipo de contacto</th>
                            <th>Solicitud</th>
                            <th colspan="2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($chats as $chat)
                            <tr>
                                @if ($chat->cliente)
                                    <td>{{ $chat->cliente->nombre }}</td>
                                    <td>{{ $chat->cliente->apellido }}</td>
                                    <td>{{ $chat->cliente->telefono }}</td>
                                @else
                                    <td>SIN REGISTRAR</td>
                                    <td>SIN REGISTRAR</td>
                                    <td>SIN REGISTRAR</td>
                                @endif
                                <td>{{ $chat->tipo }}</td>
                                <td>{{ \Carbon\Carbon::parse($chat->created_at)->format('d/m/Y - H:i') }}</td>

                                <td width="10px">
                                    <div class="btn-group">
                                        @if ($chat->cliente)
                                            <a target="_blank" href="https://wa.me/+549{{ $chat->cliente->telefono }}"
                                                class="btn btn-success btn-sm" data-toggle="tooltip"
                                                data-container=".content" title="Chatear">
                                                <i class="fab fa-whatsapp"></i>
                                            </a>
                                        @endif

                                        {{-- Finalizado --}}
                                        @if ($chat->status == 1)
                                            <button wire:loading.attr="disabled" wire:click="finalizado({{ $chat->id }})"
                                                class="btn btn-primary btn-sm" data-toggle="tooltip"
                                                data-container=".content" title="Finalizado">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        @endif

                                    </div>

                                </td>



                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

            <div class="card-footer">
                {{ $chats->links() }}
            </div>
        @else
            <div class="card-body">
                <strong>No hay registros</strong>
            </div>

        @endif

    </div>
</div>

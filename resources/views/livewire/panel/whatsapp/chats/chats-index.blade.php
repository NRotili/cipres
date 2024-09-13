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
                        <option value="-1">Atendido por humano</option>
                        <option value="-2">Atendido por bot</option>
                        <option value="2">Bot detenido</option>
                        <option value="0">Bot trabajando</option>
                        <option value="1">Sin responder</option>
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
                            <th>Nombre completo</th>
                            <th>Telefono</th>
                            <th>Tipo de contacto</th>
                            <th>Solicitud</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody wire:poll.keep-alive.30s>

                        @foreach ($chats as $chat)
                            <tr>

                                <td>{{ $chat->cliente->nombre }} {{ $chat->cliente->apellido }}</td>
                                <td>{{ $chat->cliente->telefono }}</td>
                                <td>{{ $chat->tipo }}</td>
                                <td>{{ \Carbon\Carbon::parse($chat->updated_at)->format('d/m/Y - H:i') }}</td>
                                <td>
                                    @if ($chat->status == 1)
                                        <span class="badge badge-danger">Sin responder</span>
                                    @elseif ($chat->status == -1)
                                        <span class="badge badge-success">Atendido por humano</span>
                                    @elseif ($chat->status == -2)
                                        <span class="badge badge-success">Atendido por bot</span>
                                    @elseif ($chat->status == 0)
                                        <span class="badge badge-info">Bot trabajando</span>
                                    @elseif ($chat->status == 2)
                                        <span class="badge badge-warning">Bot detenido</span>
                                    @endif
                                </td>
                                <td width="10px">
                                    <div class="btn-group">
                                        @if ($chat->cliente->telefono)
                                            <a target="_blank" href="https://wa.me/+549{{ $chat->cliente->telefono }}"
                                                class="btn btn-success btn-sm" data-toggle="tooltip"
                                                data-container=".content" title="Chatear">
                                                <i class="fab fa-whatsapp"></i>
                                            </a>
                                        @endif

                                        {{-- bot trabajando --}}
                                        @if ($chat->status == 0)
                                            <button wire:loading.attr="disabled"
                                                wire:click="botDetenido({{ $chat->id }})"
                                                class="btn btn-warning btn-sm" data-toggle="tooltip"
                                                data-container=".content" title="Detener bot">
                                                <i class="fas fa-pause"></i>
                                            </button>
                                        @endif

                                        {{-- Finalizado --}}
                                        @if ($chat->status == 1 || $chat->status==2)
                                            <button wire:loading.attr="disabled"
                                                wire:click="finalizado({{ $chat->id }})"
                                                class="btn btn-primary btn-sm" data-toggle="tooltip"
                                                data-container=".content" title="Finalizado">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            {{-- Consulta in 1 row. --}}
                            @if($chat->consulta && ($chat->status == 1))
                            <tr>
                                <td colspan="7">
                                    <div class="card">
                                        <div class="card-header">
                                            <strong>Consulta:</strong>
                                        </div>
                                        <div class="card-body">
                                            {{ $chat->consulta }}
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endif
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

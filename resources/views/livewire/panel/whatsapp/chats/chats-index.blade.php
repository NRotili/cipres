<div>
    <div class="pt-3">
        <div class="d-flex justify-content-between align-items-center" wire:poll.300s="checkServices">
            <h2 class="flex-grow-1">Whatsapp - Chats</h2>

            
            @if ($estadoServicio == 'ONLINE')
                <span class="badge badge-success mr-1 float-right">ONLINE</span>
                <div class="led led-green float-right mr-3"></div>
            @elseif ($estadoServicio == 'SCAN')
                <span class="badge badge-warning mr-1 float-right">ESCANEAR QR</span>
                <div class="led led-yellow float-right mr-3"></div>
            @elseif ($estadoServicio == 'ERROR')
                <span class="badge badge-danger mr-1 float-right">ERROR</span>
                <div class="led led-red float-right mr-3"></div>
            @endif

            <button class="btn btn-secondary float-right" wire:click="openModal" data-toggle="modal" data-target="#modalQr">
                <i class="fas fa-qrcode"></i>
            </button>
        </div>
    </div>

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
                <div class="table-responsive">
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
                        <tbody @if (!$modalVisible) wire:poll.10s @endif>

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
                                                <a target="_blank" href="https://wa.me/+{{ $chat->cliente->telefono }}"
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
                                            @if ($chat->status == 1 || $chat->status == 2)
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
                                @if ($chat->consulta && $chat->status == 1)
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


    <x-adminlte-modal id="modalQr" title="Código QR" wire:ignore.self>
        <div class="row">
            <div class="col-md-12 text-center">
                <img src="{{ $qrImage }}" alt="Código QR" />
            </div>
        </div>
        <x-slot name="footerSlot">
            <x-adminlte-button theme="danger" label="Cerrar" data-dismiss="modal" wire:click="closeModal" />
        </x-slot>
    </x-adminlte-modal>
</div>

@push('js')
    <script>
        Livewire.on('closeModalAfterDelay', () => {
            setTimeout(() => {
                @this.call('closeModal');
            }, 10000); // Cierra el modal después de 10 segundos
        });
    </script>
@endpush

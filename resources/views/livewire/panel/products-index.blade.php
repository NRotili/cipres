<div class="card">
    <div class="card-header">
        <div class="form-row">
            <div class="form-group col-md-2">

                <label for="date">Filtrar por código</label>
                <input id="date" wire:model="codigo" type="number" class="form-control" placeholder="Cód de prod.">

            </div>
            <div class="form-group col-md-5">

                <label for="nombre">Filtrar por nombre</label>
                <input id="nombre" wire:model="nombre" type="text" class="form-control"
                    placeholder="Buscar por nombre">
            </div>
            {{-- Cant por página --}}
            <div class="form-group col-md-2">
                <label for="perPage">Cant. por página</label>
                <select wire:model="cantPagina" class="form-control" id="perPage">
                    <option value="5">5</option>
                    <option selected value="10">10</option>
                    <option value="15">15</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>
            {{-- Select catalogo --}}
            <div class="form-group col-md-3">
                <label for="catalogo">Filtrar por catálogo</label>
                <select wire:model="catalogo_id" class="form-control" id="catalogo">
                    <option value="">Todos</option>
                    @foreach ($catalogos as $catalogo)
                        <option value="{{ $catalogo->id }}">{{ $catalogo->nombre }}</option>
                    @endforeach
                </select>
            </div>
        </div>


        @if ($products->count())

            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Cod.</th>
                            <th>Nombre</th>
                            <th>Precio Venta 2</th>
                            <th>Precio Venta 3</th>
                            <th>Ult. Modif</th>
                            <th class="text-center" colspan="2">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr @if (!$product->estado) style="text-decoration:line-through" @endif>
                                <td>{{ $product->codigo_producto }}</td>
                                <td>{{ $product->nombre }}</td>
                                <td>{{ $product->precioventa2 }}</td>
                                <td>{{ $product->precioventa3 }}</td>
                                <td>{{ \Carbon\Carbon::parse($product->updated_at)->format('d/m/Y - H:i') }}</td>
                                {{-- <td width="10px">
                                <a class="btn btn-primary btn-sm" href="{{route('panel.products.edit', $product)}}"><i class="fas fa-pen"></i></a>
                            </td> --}}
                                <td width="10px">
                                    <div class="btn-group">

                                        <a class="btn btn-secondary btn-sm"
                                            href="{{ route('panel.products.edit', $product) }}" data-toggle="tooltip"
                                            title="Editar" data-container=".content"><i class="fas fa-pen"></i></a>
                                        {{-- active or inactive button --}}
                                        @if ($product->estado)
                                            <a class="btn btn-warning btn-sm"
                                                wire:click="change_status({{ $product->id }}, 0)"><i class="fas fa-ban"
                                                    data-toggle="tooltip" title="Desactivar"
                                                    data-container=".content"></i></a>
                                        @else
                                            <a class="btn btn-success btn-sm" data-toggle="tooltip" title="Activar"
                                                data-container=".content"
                                                wire:click="change_status({{ $product->id }}, 1)"><i
                                                    class="fas fa-check"></i></a>
                                        @endif

                                    </div>

                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="card-footer">
                {{ $products->links() }}
            </div>
        @else
            <div class="card-body">
                <strong>No hay ningún registro</strong>
            </div>
        @endif
    </div>

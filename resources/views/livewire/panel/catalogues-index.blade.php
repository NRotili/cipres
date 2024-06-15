<div>
    <div class="card">
        <div class="card-header">
            <input wire:model.live="search" class="form-control" placeholder="Ingrese nombre de catálogo...">
        </div>



        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th class="text-center" colspan="4">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Todos los productos --}}
                    <tr>
                        <td>0</td>
                        <td>Todas las categorías</td>
                        <td width="10px">
                            <button class=" btn btn-sm btn-secondary copy-url-button"
                                data-url="{{ url('/') }}/catalogo/revendedor">REVENDEDOR</button>
                        </td>
                        <td width="10px">
                            <button class=" btn btn-sm btn-secondary copy-url-button"
                                data-url="{{ url('/') }}/catalogo/consfinal">CONSFINAL</button>
                        </td>
                        <td width="10px"></td>
                        <td width="10px"></td>
                    </tr>

                    @foreach ($catalogues as $catalogue)
                        <tr>
                            <td>{{ $catalogue->id }}</td>
                            <td>{{ $catalogue->nombre }}</td>
                            <td width="10px">
                                <button class=" btn btn-sm btn-secondary copy-url-button"
                                    data-url="{{ url('/') }}/catalogo/revendedor/{{ $catalogue->nombre }}">REVENDEDOR</button>

                            </td>
                            <td width="10px">
                                <button class=" btn btn-sm btn-secondary copy-url-button"
                                    data-url="{{ url('/') }}/catalogo/consfinal/{{ $catalogue->nombre }}">CONSFINAL</button>
                            </td>

                            <td width="10px">
                                <a class="btn btn-primary btn-sm"
                                    href="{{ route('panel.catalogues.edit', $catalogue) }}"><i
                                        class="fas fa-pen"></i></a>
                            </td>
                            <td width="10px">
                                <form action="{{ route('panel.catalogues.destroy', $catalogue) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger btn-sm"><i
                                            class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

        <div class="card-footer">
            {{ $catalogues->links() }}
        </div>

    </div>

</div>

<div>
    <div class="card">

        @if ($categorias->count())
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Cant. Productos</th>
                                <th>Productos Visibles</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categorias as $categoria)
                                <tr>
                                    <td>{{ $categoria->descripcion }}</td>
                                    <td>{{ $categoria->nombre }}</td>
                                    <td>{{ $categoria->productos->count() }}</td>
                                    <td>{{ $categoria->productos->where('estado', 1)->count() }}</td>
                                    {{-- Show categorie --}}
                                    <td width="10px">
                                        <div class="btn-group">
                                            <a href="{{ route('panel.categorias.show', $categoria) }}"
                                                class="btn btn-secondary btn-sm" data-toggle="tooltip" data-placement="top"
                                                title="Ver">
                                                <i class="fas fa-eye
                                        "></i>
                                            </a>

                                            <button wire:click="editCategoria({{ $categoria }})" data-toggle="modal"
                                        data-target="#modalCategoria" class="btn btn-warning btn-sm" ><i
                                            class="fas fa-edit"></i></button>
                                            {{-- Edit categorie --}}
                                           

                                        </div>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                {{ $categorias->links() }}
            </div>
        @else
            <div class="card-body">
                <strong>No hay registros</strong>
            </div>

        @endif
    </div>


    {{-- Modal para editar --}}

    <x-adminlte-modal wire:ignore.self id="modalCategoria" title="Nombre: {{ $categoriaModal->nombre }}">
        <div>
            <div class="row">

                <div class="col-md-12">
                    <x-adminlte-input name="categoriaModal.descripcion" label="Descripción" placeholder="Descripción"
                        wire:model.defer="categoriaModal.descripcion" />
                </div>
             
               
            </div>
            
        </div>
    </x-adminlte-modal>
</div>
<div class="card">
    <div class="card-header">
        <input wire:model="search" class="form-control" placeholder="Ingrese nombre de catálogo...">
    </div>


    @if ($catalogues->count())
        
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th class="text-center" colspan="3">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($catalogues as $catalogue)
                        <tr>
                            <td>{{$catalogue->id}}</td>
                            <td>{{$catalogue->nombre}}</td>
                            <td width="10px">
                                <a class="btn btn-secondary btn-sm" target="_blank" href="{{url('/')}}/catalogo/{{$catalogue->nombre}}"><i class="fas fa-eye"></i></a>
                            </td>
                            <td width="10px">
                                <a class="btn btn-primary btn-sm" href="{{route('panel.catalogues.edit', $catalogue)}}"><i class="fas fa-pen"></i></a>
                            </td>
                            <td width="10px">
                                <form action="{{route('panel.catalogues.destroy', $catalogue)}}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td>-</td>
                        <td>Todos los productos</td>
                        <td width="10px">
                            <a class="btn btn-secondary btn-sm" target="_blank" href="{{url('/')}}/catalogo"><i class="fas fa-eye"></i></a>
                        </td>
                        <td width="10px">
                        </td>
                        <td width="10px">
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="card-footer">
            {{$catalogues->links()}}
        </div>
    @else
        <div class="card-body">        
            <strong>No hay ningún registro</strong>
        </div>
    @endif
</div>


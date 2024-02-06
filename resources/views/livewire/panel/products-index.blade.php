<div class="card">
    <div class="card-header">
        <input wire:model="search" class="form-control" placeholder="Ingrese nombre de un producto...">
    </div>


    @if ($products->count())
        
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Precio Minorista</th>
                        <th>Precio Mayorista</th>
                        <th>Desc (%)</th>
                        <th>Ult. Modif</th>
                        <th class="text-center" colspan="2">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{$product->id}}</td>
                            <td>{{$product->nombre}}</td>
                            <td>{{$product->costo_minorista}}</td>
                            <td>{{$product->costo_mayorista}}</td>
                            <td>{{$product->descuento}}</td>
                            <td>{{$product->updated_at}}</td>
                            <td width="10px">
                                <a class="btn btn-primary btn-sm" href="{{route('panel.products.edit', $product)}}"><i class="fas fa-pen"></i></a>
                            </td>
                            <td width="10px">
                                <form action="{{route('panel.products.destroy', $product)}}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="card-footer">
            {{$products->links()}}
        </div>
    @else
        <div class="card-body">        
            <strong>No hay ningún registro</strong>
        </div>
    @endif
</div>


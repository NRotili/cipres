<div class="row">
    <div class="col col-12 col-md-6">
        <div class="form-group">
            {!! Form::label('nombre', 'Nombre') !!}
            {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre del producto']) !!}

            @error('nombre')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="col col-6 col-md-2">
        <div class="form-group">
            {!! Form::label('codigo_producto', 'Código') !!}
            {!! Form::text('codigo_producto', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el código']) !!}

            @error('codigo_producto')
                <small class="text-danger">{{ $message }}</small>
              @enderror
        </div>
    </div>
    <div class="col-12 col-md-2">
        <div class="form-group">
            {!! Form::label('precioventa2', 'Precio venta 2') !!}
            {!! Form::number('precioventa2', null, ['class' => 'form-control', 'placeholder' => 'Ingrese precio venta 2']) !!}
            @error('precioventa2')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="col-12 col-md-2">
        <div class="form-group">
            {!! Form::label('precioventa3', 'Precio venta3') !!}
            {!! Form::number('precioventa3', null, ['class' => 'form-control', 'placeholder' => 'Ingrese precio venta 3']) !!}

            @error('precioventa3')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    
    {{-- <div class="col-12 col-md-4">
        <div class="form-group">
            {!! Form::label('descuento', 'Descuento (%)') !!}
            {!! Form::number('descuento', null, ['class'=>'form-control', 'placeholder'=>'Ingrese descuento']) !!}
            
            @error('descuento')
                <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
    </div> --}}
</div>

<div class="form-group">
    <p class="font-weight-bold">Catálogos</p>

    @foreach ($catalogues as $catalogue)
        <label class="mr-3">
            {!! Form::checkbox('catalogues[]', $catalogue->id, null) !!}
            {{ $catalogue->nombre }}
        </label>
    @endforeach


    @error('catalogues')
        <br>
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>


<div class="row mb-3">
    <div class="col">
        <div class="image-wrapper">
            @isset($product->image)
                <img id="picture" src="{{ Storage::url($product->image->url) }}" alt="">
            @else
                <img id="picture" src="https://picsum.photos/700" alt="">
            @endisset
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            {!! Form::label('file', 'Imagen de producto') !!}
            {!! Form::file('file', ['class' => 'form-control-file', 'accept' => 'image/*']) !!}

            @error('file')
                <small class="text-danger">{{ $message }}</small>
            @enderror

        </div>
        <p>Si estás visualizando una foto que no tiene relación con los productos, es porque éste no tiene imagen
            asignada.</p>
        <p>Si no colocás ninguna, aparecerá en el catálogo una que indica que no hay imagen disponible.</p>
    </div>
</div>

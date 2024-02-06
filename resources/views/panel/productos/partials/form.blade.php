<div class="form-group">
    {!! Form::label('nombre', 'Nombre') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre del producto']) !!}

    @error('nombre')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="row">
    <div class="col-12 col-md-4">
        <div class="form-group">
            {!! Form::label('costo_minorista', 'Costo minorista') !!}
            {!! Form::number('costo_minorista', null, ['class' => 'form-control', 'placeholder' => 'Ingrese costo minorista']) !!}

            @error('costo_minorista')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="col-12 col-md-4">
        <div class="form-group">
            {!! Form::label('costo_mayorista', 'Costo mayorista') !!}
            {!! Form::number('costo_mayorista', null, ['class'=>'form-control', 'placeholder'=>'Ingrese costo mayorista']) !!}
            
            @error('costo_mayorista')
                <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
    </div>
    <div class="col-12 col-md-4">
        <div class="form-group">
            {!! Form::label('descuento', 'Descuento (%)') !!}
            {!! Form::number('descuento', null, ['class'=>'form-control', 'placeholder'=>'Ingrese descuento']) !!}
            
            @error('descuento')
                <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
    </div>
</div>

<div class="form-group">
    <p class="font-weight-bold">Catálogos</p>

    @foreach ($catalogues as $catalogue)
        <label class="mr-3">
            {!! Form::checkbox('catalogues[]', $catalogue->id, null) !!}
            {{$catalogue->nombre}}
        </label>
    @endforeach

    
    @error('catalogues')
        <br>
        <small class="text-danger">{{$message}}</small>
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
        <p>Si estás visualizando una foto que no tiene relación con los productos, es porque éste no tiene imagen asignada.</p>
        <p>Si no colocás ninguna, aparecerá en el catálogo una que indica que no hay imagen disponible.</p>
    </div>
</div>

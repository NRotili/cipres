<div class="form-group">
    {!! Form::label('nombre', 'Nombre') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre del catálogo']) !!}

    @error('nombre')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <p class="font-weight-bold">Categorías</p>

    @foreach ($categorias as $categoria)
        <label class="mr-3">
            {!! Form::checkbox('categorias[]', $categoria->id, null) !!}
            {{ $categoria->nombre }}
        </label>
    @endforeach


    @error('categorias')
        <br>
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

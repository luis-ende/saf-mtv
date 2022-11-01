@props(['context' => 'page', 'mode' => 'add', 'producto'])

@php($clave_cabms = isset($producto) ? $producto->clave_cabms : ( isset($step) ? $step['clave_cabms'] : old('clave_cabms')))
@php($nombre_producto = isset($producto) ? $producto->nombre : ( isset($step) ? $step['nombre_producto'] : old('nombre_producto')))
@php($descripcion_producto = isset($producto) ? $producto->descripcion : ( isset($step) ? $step['descripcion_producto'] : old('descripcion_producto')))
@php($categoria = isset($producto) ? $producto->categoria : ( isset($step) ? $step['categoria_producto'] : old('categoria_producto')))
@php($subcategoria = isset($producto) ? $producto->subcategoria : ( isset($step) ? $step['subcategoria_producto'] : old('subcategoria_producto')))
@php($marca = isset($producto) ? $producto->marca : ( isset($step) ? $step['marca'] : old('marca')))

@php($form_action = $mode === 'add' ? route('productos.store') : route('productos.update') )

<div>
    <form method="POST" action="{{ $form_action }}">
        @csrf
        <div class="form-group">
            <label>{{  $context === 'wizard' ? '¿Qué producto ofreces?' : 'Tipo de producto:' }}</label>
            <label for="tipo_producto_bien">Bien</label>
            <input type="radio" id="tipo_producto_bien" name="tipo_producto" value="1" checked>
            <label for="tipo_producto_servicio">Servicio</label>
            <input type="radio" id="tipo_producto_servicio" name="tipo_producto" value="2">
        </div>
        <div class="form-group">
            <label for="clave_cabms">Clave CABMS:</label>
            <input type="text" class="form-control" id="clave_cabms" name="clave_cabms" value="{{ $clave_cabms }}" required>
            <x-input-error :messages="$errors->get('clave_cabms')" class="mt-2" />
        </div>
        <div class="form-group">
            <label for="nombre_producto">Nombre del producto:</label>
            <input type="text" class="form-control" id="nombre_producto" name="nombre_producto" value="{{ $nombre_producto }}" required>
            <x-input-error :messages="$errors->get('nombre_producto')" class="mt-2" />
        </div>
        <div class="form-group">
            <label for="descripcion">Descripcion:</label>
            <textarea type="text" class="form-control" id="descripcion_producto" name="descripcion_producto">{{ $descripcion_producto }}</textarea>
            <x-input-error :messages="$errors->get('descripcion_producto')" class="mt-2" />
        </div>
        <div class="form-group">
            <label for="categoria">Categoría:</label>
            <input type="text" class="form-control" id="categoria_producto" name="categoria_producto" value="{{ $categoria }}">            
        </div>
        <div class="form-group">
            <label for="subcategoria">Subcategoría:</label>
            <input type="text" class="form-control" id="subcategoria_producto" name="subcategoria_producto" value="{{ $subcategoria }}">
        </div>
        <div class="form-group">
            <label for="marca">Marca:</label>
            <input type="text" class="form-control" id="marca" name="marca" value="{{ $marca }}">
        </div>

        @if ($mode === 'add')
            <button class="btn btn-primary" type="submit">Agregar producto</button>
        @else
            <button class="btn btn-primary" type="submit">Guardar</button>
        @endif
    </form>
</div>

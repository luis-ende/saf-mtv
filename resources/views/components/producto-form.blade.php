@props(['mode' => 'add', 'producto', 'wizard'])

@php($tipoProducto = isset($producto) ? $producto->tipo : ( isset($step) ? $step['tipo_producto'] : old('tipo_producto')))
@php($claveCABMS = isset($producto) ? $producto->clave_cabms : ( isset($step) ? $step['clave_cabms'] : old('clave_cabms')))
@php($nombreProducto = isset($producto) ? $producto->nombre : ( isset($step) ? $step['nombre_producto'] : old('nombre_producto')))
@php($descripcionProducto = isset($producto) ? $producto->descripcion : ( isset($step) ? $step['descripcion_producto'] : old('descripcion_producto')))
@php($precio = isset($producto) ? $producto->precio : ( isset($step) ? $step['precio'] : old('precio')))
@php($marca = isset($producto) ? $producto->marca : ( isset($step) ? $step['marca'] : old('marca')))
@php($modelo = isset($producto) ? $producto->modelo : ( isset($step) ? $step['modelo'] : old('modelo')))
@php($color = isset($producto) ? $producto->color : ( isset($step) ? $step['color'] : old('color')))
@php($material = isset($producto) ? $producto->material : ( isset($step) ? $step['material'] : old('material')))

@if ($mode === 'add')
    @php($formAction = route('productos.store'))
@elseif ($mode === 'wizard')
    @php($formAction = route('wizard.registro-mtv.update', [$wizard['id'], 'catalogo-productos']))
@elseif ($mode === 'edit')
    @php($formAction = route('productos.update', $producto->id))
@endif

{{--@include('layouts.registro-navigation')--}}
<div class="container" x-data="{ tipoProducto: '{{ $tipoProducto ?? 'B' }}' }">
    @if ($mode === 'wizard')
        <h1>{{ $wizard['title'] }}</h1>
        <h2>3. Tus productos</h2><br>
    @endif
        <form method="POST" action="{{ $formAction }}">
            @csrf
            <div class="row">
                <div class="form-group col-md-4">
                    <label>¿Qué producto ofreces?</label>
                    <div class="form-check">
                        <label class="form-check-label" for="tipo_producto_bien">Bien</label>
                        <input type="radio"
                               class="form-check-input"
                               id="tipo_producto_bien"
                               x-model="tipoProducto"
                               name="tipo_producto"
                               value="B"
                        >
                    </div>
                    <div class="form-check">
                        <label class="form-check-label" for="tipo_producto_servicio">Servicio</label>
                        <input type="radio"
                               class="form-check-input"
                               id="tipo_producto_servicio"
                               x-model="tipoProducto"
                               name="tipo_producto"
                               value="S"
                        >
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-3">
                    <label for="clave_cabms">Clave CABMS:</label>
                    <input type="text"
                           class="form-control"
                           id="clave_cabms"
                           name="clave_cabms"
                           value="{{ $claveCABMS }}" required>
                </div>
                <div class="form-group col-md-9">
                    <label for="nombre_producto">Nombre del producto:</label>
                    <input type="text" class="form-control" id="nombre_producto" name="nombre_producto"
                           value="{{ $nombreProducto }}" required>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="descripcion_producto">Descripcion:</label>
                    <textarea class="form-control" id="descripcion_producto"
                              name="descripcion_producto" maxlength="140">{{ $descripcionProducto }}</textarea>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="precio">Precio:</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text">$</span>
                        <input type="number"
                               min="0"
                               step=".01"
                               class="form-control"
                               id="precio" name="precio"
                               value="{{ $precio }}" required>
                    </div>
                </div>
                <div class="form-group col-md-4" x-show="tipoProducto === 'B'">
                    <label for="marca">Marca:</label>
                    <input type="text" class="form-control" id="marca" name="marca"
                           value="{{ $marca }}">
                </div>
                <div class="form-group col-md-4" x-show="tipoProducto === 'B'">
                    <label for="modelo">Modelo:</label>
                    <input type="text" class="form-control" id="modelo" name="modelo"
                           value="{{ $modelo }}">
                </div>
                <div class="form-group col-md-4" x-show="tipoProducto === 'B'">
                    <label for="color">Color:</label>
                    <input type="text" class="form-control" id="color" name="color"
                           value="{{ $color }}">
                </div>
                <div class="form-group col-md-4" x-show="tipoProducto === 'B'">
                    <label for="material">Material:</label>
                    <input type="text" class="form-control" id="material" name="material"
                           value="{{ $material }}">
                </div>
            </div>

            @if ($mode === 'add')
                <button class="btn btn-primary" type="submit">Agregar producto</button>
            @elseif ($mode === 'wizard')
                <a class="btn btn-primary" href="{{ route('wizard.registro-mtv.show', [$wizard['id'], 'descripcion-negocio']) }}">Anterior</a>
                <button id="btn_siguiente" class="btn btn-primary">Finalizar</button>
            @else
                <button class="btn btn-primary" type="submit">Guardar</button>
            @endif
        </form>
</div>

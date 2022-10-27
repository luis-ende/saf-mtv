{{--@include('layouts.registro-navigation')--}}
<x-guest-layout>
    <div class="container">
        {{ $wizard['title'] }}
        <h1>3. Tus productos</h1><br>
        @php($wizardId = $wizard['id'])
        <form method="POST" action="{{ route('wizard.registro-mtv.update', [$wizardId, 'catalogo-productos']) }}">
            @csrf
            <div class="form-group">
                <label>¿Qué producto ofreces?</label>
                <label for="tipo_producto_bien">Bien</label>
                <input type="radio" id="tipo_producto_bien" name="tipo_producto" value="1" checked>
                <label for="tipo_producto_servicio">Servicio</label>
                <input type="radio" id="tipo_producto_servicio" name="tipo_producto" value="2">
            </div>
            <div class="form-group">
                <label for="clave_cabms">Clave CABMS:</label>
                <input type="text" class="form-control" id="clave_cabms" name="clave_cabms" value="{{ $step['clave_cabms'] ?? old('clave_cabms') }}">
            </div>
            <div class="form-group">
                <label for="nombre_producto">Nombre del producto:</label>
                <input type="text" class="form-control" id="nombre_producto" name="nombre_producto" value="{{ $step['nombre_producto'] ?? old('nombre_producto') }}">
            </div>
            <div class="form-group">
                <label for="descripcion">Descripcion:</label>
                <input type="text" class="form-control" id="descripcion" name="descripcion_producto" value="{{ $step['descripcion_producto'] ?? old('descripcion_producto') }}">
            </div>
            <div class="form-group">
                <label for="categoria">Categoría:</label>
                <input type="text" class="form-control" id="categoria" name="categoria_producto" value="{{ $step['categoria_producto'] ?? old('categoria_producto') }}">
            </div>
            <div class="form-group">
                <label for="subcategoria">Subcategoría:</label>
                <input type="text" class="form-control" id="subcategoria" name="subcategoria_producto" value="{{ $step['subcategoria_producto'] ?? old('subcategoria_producto') }}">
            </div>
            <div class="form-group">
                <label for="marca">Marca:</label>
                <input type="text" class="form-control" id="marca" name="marca" value="{{ $step['marca'] ?? old('marca') }}">
            </div>

            <a class="btn btn-primary" href="{{ route('wizard.registro-mtv.show', [$wizardId, 'descripcion-negocio']) }}">Anterior</a>
            <input class="btn btn-primary" type="submit" value="Finalizar">
        </form>
    </div>
</x-guest-layout>

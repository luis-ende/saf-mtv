@props(['producto' => null])

@if($producto->tipo === 'B')
    <div class="md:grid md:grid-cols-2 md:gap-2">
        <div class="mtv-input-wrapper">
            <input type="text" class="mtv-text-input" id="marca" name="marca"
                    value="{{ $producto->marca }}">
            <label class="mtv-input-label" for="marca">Marca</label>
        </div>
        <div class="mtv-input-wrapper">
            <input type="text" class="mtv-text-input" id="modelo" name="modelo"
                value="{{ $producto->modelo }}">
            <label class="mtv-input-label" for="modelo">Modelo o SKU</label>
        </div>

        <x-input-producto-color-select
            :producto_colores="$producto->productoColor"
        />

        <div class="mtv-input-wrapper">
            <input type="text" class="mtv-text-input" id="material" name="material"
                value="{{ $producto->material }}">
            <label class="mtv-input-label" for="material">Material</label>
        </div>
        <div class="mtv-input-wrapper">
            <input type="text" class="mtv-text-input" id="codigo_barras" name="codigo_barras"
                value="{{ $producto->codigoBarras }}">
            <label class="mtv-input-label" for="material">Código de barras</label>
        </div>
    </div>
@endif
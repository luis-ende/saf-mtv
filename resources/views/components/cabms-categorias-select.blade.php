@props(['modo' => 'producto_edicion'])

<div class="mtv-input-wrapper w-full mx-auto"
     @if ($modo === 'producto_edicion')
     x-init="$watch('productoEditado', value => { cargaProductoCABMSCategorias(value) })"
    @endif
    >
    <div class="mtv-input-wrapper">
        <select class="mtv-text-input text-base"
                id="id_cabms"
                name="id_cabms"
                @change="buscaCategorias($event.target.value)"
                x-ref="selectCategoriaScian">
        </select>
        <label class="mtv-input-label" for="id_cabms">Nombre</label>
    </div>
</div>
<div class="mtv-input-wrapper w-full mx-auto">
    <select class="mtv-text-input text-base"
            id="categorias_scian"
            name="ids_categorias_scian[]"            
            multiple>
    </select>
    <label class="mtv-input-label" for="categorias_scian">Categoría(s)</label>    
</div>

<div class="mtv-input-wrapper w-full mx-auto">
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
            @change="setSeleccionCategorias($event.target)"
            multiple>
    </select>
    <input type="hidden" id="ids_categorias_scian" name="ids_categorias_scian" x-model="seleccionCategorias">
    <label class="mtv-input-label" for="ids_categorias_scian">Categoría(s)</label>
</div>

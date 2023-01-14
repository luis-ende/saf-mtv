@props(['value' => null])

<div class="mtv-input-wrapper">
    <input type="text" class="mtv-text-input" id="nombre" name="nombre"
        value="{{ $value }}" required>
    <label class="mtv-input-label" for="nombre">Nombre de tu producto<span class="text-mtv-primary">*</span></label>
</div>
<label class="text-xs text-slate-500 mx-3 italic"
    for="descripcion_producto">
    Aparecerá como título en el catálogo
</label>
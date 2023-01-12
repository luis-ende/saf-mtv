@props(['value' => null])

<div class="mtv-input-wrapper">
    <textarea class="mtv-text-input" id="descripcion"
            name="descripcion" maxlength="140" required>{{ $value }}</textarea>
    <label class="mtv-input-label" for="descripcion">Describe tu producto<span class="text-mtv-primary">*</span></label>
</div>
<label class="text-xs text-slate-500 mx-3 italic"
    for="producto">
        Indica en qué unidad de medida vendes tu producto, qué presentación tiene, fabricante y otras características importantes con las que cuenta tu producto.
</label>
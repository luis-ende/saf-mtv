@props(['tipo_producto' => 'B', 'disabled' => false])

<div class="basis-1/2 flex flex-row justify-start">
    <input type="radio"
           class="self-center mr-4 focus:ring-slate-200"
           id="tipo_producto_bien"
           name="tipo_producto"
           x-model="tipoProducto"
           value="B"
           {{ $tipo_producto === 'B' ? 'checked' : '' }}
           {{ $disabled ? 'disabled' : '' }}
    >
    <label
        :class="tipoProducto === 'B' ? 'font-bold text-lg text-mtv-secondary' : 'text-lg text-mtv-gray'"
        for="tipo_producto_bien">Bien</label>
</div>
<div class="basis-1/2 flex flex-row justify-end">
    <input type="radio"
           class="self-center mr-4 focus:ring-slate-200"
           id="tipo_producto_servicio"
           name="tipo_producto"
           x-model="tipoProducto"
           value="S"
           {{ $tipo_producto === 'S' ? 'checked' : '' }}
           {{ $disabled ? 'disabled' : '' }}
    >
    <label
        :class="tipoProducto === 'S' ? 'font-bold text-lg text-mtv-secondary' : 'text-lg text-mtv-gray'"
        for="tipo_producto_servicio">Servicio</label>
</div>
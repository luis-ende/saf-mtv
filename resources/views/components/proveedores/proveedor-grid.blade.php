@props(['proveedores' => []])

<div class="grid md:grid-cols-4 md:gap-7 sm:grid-cols-2 sm:gap-2">
    @foreach($proveedores as $proveedor)
        <x-proveedores.proveedor-card
            :proveedor="$proveedor"
        />
    @endforeach
</div>

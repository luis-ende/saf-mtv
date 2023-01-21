@props(['proveedores' => []])

@foreach($proveedores as $proveedor)
    <x-proveedores.proveedor-card
            :proveedor="$proveedor"
    />
@endforeach
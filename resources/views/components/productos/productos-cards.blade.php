@props([
    'modo' => 'proveedor', // 'proveedor', 'busqueda', 'visitante'
    'productos' => []
])

@foreach($productos as $producto)
    <x-productos.producto-card
            :producto="$producto"
            :modo="$modo"
    />
@endforeach
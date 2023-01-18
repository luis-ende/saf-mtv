@props([
    'modo' => 'catalogo', // 'catalogo', 'busqueda'
    'productos' => []
])

<div class="grid md:grid-cols-4 md:gap-7 sm:grid-cols-2 sm:gap-2">
    @foreach($productos as $producto)
        <x-productos.producto-card
            :producto="$producto"
            :modo="$modo"
         />
    @endforeach
</div>
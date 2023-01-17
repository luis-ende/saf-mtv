@props(['productos' => []])

<div class="w-full font-bold text-xl text-mtv-text-gray border-b-2 mb-4">
    Productos relacionados
</div>
<div class="flex flex-row space-x-5">
    @foreach($productos as $producto)
        <x-productos.producto-card
            :producto="$producto"
            modo="visitante"
        />
    @endforeach
</div>

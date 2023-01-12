@props(['productos' => []])

<div class="grid md:grid-cols-4 md:gap-7 sm:grid-cols-2 sm:gap-2">
    @foreach($productos as $producto)
        <x-producto-card
            :producto="$producto"
         />
    @endforeach
</div>

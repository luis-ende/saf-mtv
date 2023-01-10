@props(['producto' => null])

<article>
    <div class="flex flex-col">
        <div class="flex flex-row mb-1">
            <span class="text-mtv-gold uppercase text-xs basis-1/2 text-start">PARTIDA: {{ $producto?->partida }}</span>
            <span class="text-mtv-gold uppercase text-xs basis-1/2 text-end">CABMS-{{ $producto?->cabms }}</span>
        </div>        
        <div class="border rounded border-mtv-gray p-2">
            <div class="mb-3">
                <img class="object-cover w-64 h-48" src="https://images.unsplash.com/photo-1531876137992-22b6ce5221f1?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=765&q=80">
            </div>
            @isset($producto->proveedor)
            <p class="text-mtv-gold uppercase m-0">{{ $producto->proveedor }}</p>
            @endisset
            <a href="{{ route('productos.edit', [$producto->id]) }}"
               class="text-mtv-primary hover:text-mtv-primary no-underline font-bold m-0" >
               {{ $producto->nombre }}
            </a>            
            <div class="text-mtv-primary my-2">
                @svg('uiw-paper-clip', ['class' => 'w-5 h-5 inline-block mr-3'])
                1
            </div>
        </div>        
    </div>
</article>
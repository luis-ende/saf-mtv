@props(['producto' => null])

<article>
    <div class="flex flex-col">
        <div class="flex flex-row mb-1">
            <span class="text-mtv-gold uppercase text-xs basis-1/2 text-start">PARTIDA: {{ $producto?->partida }}</span>
            <span class="text-mtv-gold uppercase text-xs basis-1/2 text-end">CABMS-{{ $producto?->cabms }}</span>
        </div>        
        <div class="border rounded border-mtv-gray p-2">
            <div class="mb-3">
                @if($producto->foto_info && $producto->foto_info->original_url)
                    <a href="{{ route('productos.show', [$producto->id]) }}">
                        <img class="object-cover w-64 h-48" src="{{ $producto?->foto_info?->original_url }}">
                    </a>
                @else
                    @svg('ri-image-fill', ['class' => 'text-mtv-gray-light w-64 h-48 inline-block'])                
                @endif
            </div>
            @isset($producto->proveedor)
            <p class="text-mtv-gold uppercase m-0">{{ $producto->proveedor }}</p>
            @endisset
            <a href="{{ route('productos.show', [$producto->id]) }}"
               class="text-mtv-primary hover:text-mtv-primary no-underline font-bold m-0" >
               {{ $producto->nombre }}
            </a>            
            <div class="text-mtv-primary my-2">
                @svg('heroicon-s-heart', ['class' => 'w-5 h-5 inline-block mr-2'])
                1
            </div>
        </div>        
    </div>
</article>
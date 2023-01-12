@props(['producto' => null])

<article class="md:mb-0 xs:mb-5">
    <div class="flex flex-col">
        <div class="flex flex-row mb-1">
            <span class="text-mtv-gold uppercase text-xs basis-1/2 text-start">PARTIDA: {{ $producto?->partida }}</span>
            <span class="text-mtv-gold uppercase text-xs basis-1/2 text-end">CABMS-{{ $producto?->cabms }}</span>
        </div>
        <div class="border rounded border-mtv-gray p-2">
            <div class="mb-3">
                <a href="{{ route('productos.show', [$producto->id]) }}">
                @if($producto->foto_info && $producto->foto_info->original_url)
                    <img class="object-cover w-64 h-48 mx-auto" src="{{ $producto?->foto_info?->original_url }}">
                @else
                    @svg('ri-image-fill', ['class' => 'text-mtv-gray-light w-24 h-48 mx-auto'])
                @endif
                </a>
            </div>
            @isset($producto->proveedor)
            <p class="text-mtv-gold uppercase m-0">{{ $producto->proveedor }}</p>
            @endisset
            <a href="{{ route('productos.show', [$producto->id]) }}"
               class="text-mtv-primary hover:text-mtv-primary no-underline font-bold m-0" >
               {{ $producto->nombre }}
            </a>
            <div class="text-mtv-primary my-2">
                @svg('gmdi-favorite-r', ['class' => 'w-5 h-5 inline-block mr-2'])
                1
            </div>
        </div>
    </div>
</article>

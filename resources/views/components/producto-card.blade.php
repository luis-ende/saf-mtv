@props([
    'modo' => 'catalogo', // 'catalogo', 'busqueda'
    'producto' => null
])

<article class="md:mb-0 xs:mb-5">
    <div class="flex flex-col">
        <div class="flex flex-row mb-1">
            <span class="text-mtv-gold uppercase text-xs basis-1/2 text-start">PARTIDA: {{ $producto?->partida }}</span>
            <span class="text-mtv-gold uppercase text-xs basis-1/2 text-end">CABMS-{{ $producto?->cabms }}</span>
        </div>
        @php($productoRoute = $modo === 'catalogo' ? route('productos.show', [$producto->id]) : route('proveedor-producto.show', [$producto->id]))
        <div class="border rounded border-mtv-gray p-2">
            <div class="mb-3">
                <a href="{{ $productoRoute }}">
                @if($producto->foto_info && $producto->foto_info->original_url)
                    <img class="object-cover w-64 h-48 mx-auto" src="{{ $producto?->foto_info?->original_url }}">
                @else
                    @svg('ri-image-fill', ['class' => 'text-mtv-gray-light w-24 h-48 mx-auto'])
                @endif
                </a>
            </div>
            @if($modo === 'busqueda')
                <div>
                    <a href="{{ route('proveedor-producto.show', [$producto->id]) }}" 
                       class="mtv-link-gold uppercase m-0">
                        {{ $producto->nombre_negocio }}
                    </a>
                </div>
            @endif            
                        
            <a href="{{ $productoRoute }}"
               class="text-mtv-primary hover:text-mtv-primary no-underline font-bold m-0" >
               {{ $producto->nombre }}
            </a>

            <div class="my-2">
                <x-producto-favoritos-input />
            </div>
        </div>
    </div>
</article>

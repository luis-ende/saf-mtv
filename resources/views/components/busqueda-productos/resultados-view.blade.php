@props(['resultados' => null, 'tipo_busqueda' => null])

<div class="w-full my-10">
    @if(!empty($resultados))
        @if($resultados->isEmpty())
            <div class="text-center text-lg text-mtv-text-gray-light">
                No se encontraron {{ $tipo_busqueda  }}.
            </div>
        @else
            @if($tipo_busqueda === 'productos')
                <x-productos.productos-grid
                    modo="busqueda"
                    :productos="$resultados" />
            @elseif($tipo_busqueda === 'proveedores')
                <x-proveedores.proveedores-grid
                    :proveedores="$resultados" />
            @endif
        @endif
    @endif
</div>
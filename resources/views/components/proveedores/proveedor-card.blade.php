@props(['proveedor' => null])

<article class="md:mb-0 xs:mb-5">
    <div class="flex flex-col">
        <div class="flex flex-row mb-1">
            <span class="text-mtv-gold uppercase text-xs basis-1/2 text-start ml-2">{{ $proveedor->nombre_negocio }}</span>
        </div>
        @php($proveedorRoute = route('proveedor-perfil.show', [$proveedor->id_persona]))
        <div class="border rounded border-mtv-gray p-2 flex flex-col space-y-2">
            <div class="p-3">
                <a href="{{ $proveedorRoute }}">
                    @if($proveedor->logo_info && $proveedor->logo_info->original_url)
                        <img class="object-cover w-64 h-48 mx-auto" src="{{ $proveedor?->logo_info?->original_url }}">
                    @else
                        @svg('ri-image-fill', ['class' => 'text-mtv-gray-light w-24 h-48 mx-auto'])
                    @endif
                </a>
            </div>

            <div class="text-mtv-text-gray sm:text-sm xs:text-xs uppercase">
                Sector: {{ $proveedor->sector }}
            </div>
            <div class="text-mtv-text-gray sm:text-sm xs:text-xs uppercase">
                Giro: {{ $proveedor->categoria_scian }}
            </div>
            <div class="text-mtv-text-gray sm:text-sm xs:text-xs uppercase">
                Constancia:
            </div>
            <div class="flex flex-row flex-wrap my-2 text-mtv-gold mt-3 justify-between" x-data="tooltips()">
                <a id="perfil-negocio" href="{{ $proveedorRoute }}"
                   class="mtv-link-gold self-baseline">
                    @svg('lineawesome-user-check-solid', ['class' => 'w-7 h-7'])
                </a>
                <a id="catalogo-pdf" href="#" class="mtv-link-gold self-baseline">
                    @svg('icono_catalogo_PDF', ['class' => 'w-7 h-7'])
                </a>
                <a id="catalogo" href="{{ route('proveedor-catalogo-productos.show', [$proveedor->id_cat_productos]) }}"
                   class="mtv-link-gold self-baseline">
                    @svg('icono_catalogo', ['class' => 'w-7 h-7'])
                </a>
            </div>
            <script>
                function tooltips() {
                    return {
                        tooltipPerfilNegocio: new bootstrap.Tooltip(document.getElementById('perfil-negocio'), {
                            customClass: 'custom-tooltip',
                            title: 'Perfil'
                        }),
                        tooltipCatalogoPDF: new bootstrap.Tooltip(document.getElementById('catalogo-pdf'), {
                            customClass: 'custom-tooltip',
                            title: 'Catálogo PDF'
                        }),
                        tooltipCatalogo: new bootstrap.Tooltip(document.getElementById('catalogo'), {
                            customClass: 'custom-tooltip',
                            title: 'Catálogo'
                        }),
                    }
                }
            </script>
        </div>
    </div>
</article>

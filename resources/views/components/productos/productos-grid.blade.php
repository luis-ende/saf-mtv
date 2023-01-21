@props([
    'modo' => 'catalogo', // 'catalogo', 'busqueda'
    'productos' => []
])

@if($modo === 'busqueda')
<div x-data="inifiniteScrolling()"
    x-init="$watch('htmlData', value => $refs.productosGrid.innerHTML += htmlData)">
@endif

    <div class="grid md:grid-cols-4 md:gap-7 sm:grid-cols-2 sm:gap-2" x-ref="productosGrid">
        @foreach($productos as $producto)
            <x-productos.producto-card
                :producto="$producto"
                :modo="$modo"
            />
        @endforeach
    </div>

@if($modo === 'busqueda')
    <button x-show="!maxResultados" class="mtv-button-gray uppercase w-full my-5" type="button"
            @click="retrieveData();"
    >Ver más resultados</button>
</div>

<script type="text/javascript">
    function inifiniteScrolling() {
        return {
            get maxResultados() {
                return this.numResults < this.paginationOffset;
            },
            paginationOffset: @json($pagination_offset),
            nextOffset: @json($pagination_offset),
            htmlData: null,
            numResults: @json(count($productos)),
            filtros: @json(request()->except('_token')),
            async retrieveData() {
                {{-- Remueve elementos con valor nulo --}}
                const filtrosValidos = Object.fromEntries(Object.entries(this.filtros).filter(([_, v]) => v != null));
                const filtrosParams = new URLSearchParams(filtrosValidos);
                filtrosParams.append('offset', this.nextOffset);

                this.htmlData = await (await fetch('{{ route('buscador-mtv.items-cards') }}' + '?' + filtrosParams, {
                        method: 'GET',
                        headers: { 'X-Requested-With': 'XMLHttpRequest' }
                    })).text();

                let parser = new DOMParser();
                let parseDocument = parser.parseFromString(this.htmlData, 'text/html');
                this.numResults = parseDocument.getElementsByTagName('article').length;
                this.nextOffset += this.paginationOffset;
            }
        }
    }
</script>
@endif
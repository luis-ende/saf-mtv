@props(['filtros_opciones' => []])

<ul class="bg-white text-mtv-text-gray">
    <x-oportunidades.buscador-filtro-seccion titulo="Rubro de gasto" key="1">
        <ul class="list-none list-outside pb-4 flex flex-col space-y-2">
            @foreach($filtros_opciones['capitulos'] as $capitulo)
                <li>
                    <input class="mr-2 border focus:ring-mtv-secondary" type="checkbox" id="capitulo-{{ $capitulo }}" name="capitulo_filtro[]" value="{{ $capitulo }}">
                    <label for="capitulo-{{ $capitulo }}">{{ $capitulo }}</label>
                </li>
            @endforeach
        </ul>
    </x-oportunidades.buscador-filtro-seccion>

    <x-oportunidades.buscador-filtro-seccion titulo="Instituciones compradoras" key="2">
        <div class="mb-4 flex flex-col space-y-3 pl-4"
             x-data="unidadesCompradoras()"
             x-init="initUnidadesCompradoras()">
            <input type="text" placeholder="Buscar"
                   @keyup="search($event.target.value)"
                   class="mt-1 ml-4 w-10/12 bg-gray-50 border border-gray-300 text-mtv-text-gray text-sm rounded focus:ring-mtv-secondary focus:border-mtv-secondary">
            <div class="h-64 w-11/12 overflow-y-scroll">
                <ul class="pl-4 list-none list-outside flex flex-col space-y-2 text-sm">
                    <li class="flex flex-row flex-nowrap items-center">
                        <input class="mr-2 border focus:ring-mtv-secondary" type="checkbox" id="unidad-c-0" name="unidad_compradora_filtro[]" value="0">
                        <label class="font-bold" for="unidad-c-0">Todos</label>
                    </li>
                    <template x-for="(unidad, index) in unidadesFiltradas" :key="index">
                        <li class="flex flex-row flex-nowrap items-start">
                            <input class="mr-2 border focus:ring-mtv-secondary"
                                   type="checkbox" x-bind:id="'unidad-c-' + unidad.id"
                                   name="unidad_compradora_filtro[]"
                                   x-bind:value="unidad.id">
                            <label x-bind:for="'unidad-c-' + unidad.id" x-text="unidad.unidad"></label>
                        </li>
                    </template>
                </ul>
            </div>
            <script type="text/javascript">
                function unidadesCompradoras() {
                    return {
                        unidades: @js($filtros_opciones['unidades_compradoras']),
                        unidadBusqueda: '',
                        initUnidadesCompradoras() {
                            this.unidadesFiltradas = this.unidades;
                        },
                        search(value) {
                            if (value.length > 1) {
                                const options = {
                                    isCaseSensitive: false,
                                    shouldSort: false,
                                    keys: ['unidad'],
                                    threshold: 0.6,
                                }
                                const fuse = new Fuse(this.unidades, options);
                                this.unidadesFiltradas = fuse.search(value).map(elem => elem.item);
                            } else {
                                this.unidadesFiltradas = this.unidades;
                            }
                        }
                    }
                }
            </script>
        </div>
    </x-oportunidades.buscador-filtro-seccion>

    <x-oportunidades.buscador-filtro-seccion titulo="Tipo de contratación" key="3">
        <ul class="list-none list-outside pb-4 flex flex-col space-y-2">
            <li>
                <input class="mr-2 border focus:ring-mtv-secondary" type="checkbox" id="tipo-contr-bien" name="tipo_contr_filtro[]" value="bien">
                <label for="tipo-contr-bien">Bien</label>
            </li>            
            <li>
                <input class="mr-2 border focus:ring-mtv-secondary" type="checkbox" id="capitulo-servicio" name="tipo_contr_filtro[]" value="servicio">
                <label for="tipo-contr-servicio">Servicio</label>
            </li>            
        </ul>
    </x-oportunidades.buscador-filtro-seccion>

    <x-oportunidades.buscador-filtro-seccion titulo="Método de contratación" key="4">
        Item 4
    </x-oportunidades.buscador-filtro-seccion>

    <x-oportunidades.buscador-filtro-seccion titulo="Etapa del procedimiento" key="5">
        Item 5
    </x-oportunidades.buscador-filtro-seccion>

    <x-oportunidades.buscador-filtro-seccion titulo="Estatus contratación" key="6">
        Item 6
    </x-oportunidades.buscador-filtro-seccion>

    <x-oportunidades.buscador-filtro-seccion titulo="Fecha de inicio" key="7">
        Item 7
    </x-oportunidades.buscador-filtro-seccion>
</ul>    
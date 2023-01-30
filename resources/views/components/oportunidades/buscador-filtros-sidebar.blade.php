@props(['filtros_opciones' => []])

<ul class="bg-white text-mtv-text-gray md:px-7 xs:px-2">
    <x-oportunidades.buscador-filtro-seccion titulo="Grandes rubros de gastos" key="1">
        <ul class="list-none list-outside pl-0 pb-4 flex flex-col space-y-2 ml-1">
            @foreach($filtros_opciones['capitulos'] as $capitulo)
                <li>
                    <input class="mr-2 border focus:ring-mtv-secondary" 
                           type="checkbox" id="capitulo-{{ $capitulo->id }}" 
                           name="capitulo_filtro[]" value="{{ $capitulo->id }}">
                    <label for="capitulo-{{ $capitulo->id }}">
                        {{ $capitulo->numero }} - {{ $capitulo->nombre }}
                    </label>
                </li>
            @endforeach
        </ul>
    </x-oportunidades.buscador-filtro-seccion>

    <x-oportunidades.buscador-filtro-seccion titulo="Instituciones compradoras" key="2">
        <div class="mb-4 flex flex-col space-y-3"
             x-data="unidadesCompradoras()"
             x-init="initUnidadesCompradoras()">
            <input type="text" placeholder="Buscar"
                   @keyup="search($event.target.value)"
                   class="ml-0 mt-1 w-96 bg-gray-50 border border-gray-300 text-mtv-text-gray text-sm rounded focus:ring-0">
            <div class="h-64 w-96 overflow-y-scroll">
                <ul class="pl-0 mt-1 ml-1 list-none list-outside flex flex-col space-y-2 text-sm" x-id="['unidad-c']">
                    <li class="flex flex-row flex-nowrap items-center">
                        <input class="mr-2 border focus:ring-mtv-secondary" type="checkbox" id="unidad-c-0" name="unidad_compradora_filtro[]" value="0">
                        <label class="font-bold" for="unidad-c-0">Todos</label>
                    </li>
                    <template x-for="(unidad, index) in unidades" :key="index">
                        <li x-show="unidad.visible" class="flex flex-row flex-nowrap items-start">
                            <input class="mr-2 border focus:ring-mtv-secondary"
                                   type="checkbox" :id="$id('unidad-c', unidad.id)"
                                   name="unidad_compradora_filtro[]"
                                   x-bind:value="unidad.id">
                            <label :for="$id('unidad-c', unidad.id)" x-html="highlightKeyword(unidad.nombre, searchKeyword)"></label>
                        </li>
                    </template>
                </ul>
            </div>
            <script type="text/javascript">
                function unidadesCompradoras() {
                    return {
                        unidades: [],
                        unidadBusqueda: '',
                        searchKeyword: '',
                        initUnidadesCompradoras() {
                            const unidades = @js($filtros_opciones['unidades_compradoras']);
                            this.unidades = unidades.map(u => {
                                return {
                                    ...u,
                                    visible: true,
                                }
                            });
                        },
                        search(value) {
                            this.searchKeyword = value;
                            if (value.length > 1) {
                                const options = {
                                    {{-- Buscar sólo en la propiedad del nombre de la unidad --}}
                                    keys: ['nombre'],
                                    includeScore: true,
                                }
                                const fuse = new Fuse(this.unidades, options);
                                const scores = fuse.search(value);

                                this.unidades.forEach((u, index) => {
                                    this.unidades[index].visible = false;
                                });

                                scores.forEach(unidad => {
                                    if (unidad.score > 0 && unidad.score <= 0.6) {
                                        this.unidades[unidad.refIndex].visible = true;
                                    }
                                });
                            } else {
                                this.unidades.forEach((u, index) => {
                                    this.unidades[index].visible = true;
                                });
                            }
                        },
                        highlightKeyword(text, keyword) {
                            if (keyword !== "") {
                                let words = text.split(' ');
                                const fuse = new Fuse(words, { includeScore: true });
                                const scores = fuse.search(keyword);
                                scores.forEach(word => {
                                    if (word.score <= 0.3) {
                                        words[word.refIndex] = `<mark>${word.item}</mark>`;
                                    }
                                });

                                return words.join(' ');
                            }

                            return text;
                        },
                    }
                }
            </script>
        </div>
    </x-oportunidades.buscador-filtro-seccion>

    <x-oportunidades.buscador-filtro-seccion titulo="Tipo de contratación" key="3">
        <ul class="list-none list-outside pl-0 pb-4 flex flex-col space-y-2 ml-1">
            @foreach($filtros_opciones['tipos_contratacion'] as $tipoContr)
                <li>
                    <input class="mr-2 border focus:ring-mtv-secondary" 
                           type="checkbox" id="tipo-contr-{{ $tipoContr->id }}" 
                           name="tipo_contr_filtro[]" value="{{ $tipoContr->id }}">
                    <label for="tipo-contr-{{ $tipoContr->id }}">{{ $tipoContr->tipo }}</label>
                </li>
            @endforeach
        </ul>        
    </x-oportunidades.buscador-filtro-seccion>

    <x-oportunidades.buscador-filtro-seccion titulo="Método de contratación" key="4">
        <ul class="list-none list-outside pl-0 pb-4 flex flex-col space-y-2 ml-1">
            @foreach($filtros_opciones['metodos_contratacion'] as $metodoContr)
                <li>
                    <input class="mr-2 border focus:ring-mtv-secondary" 
                           type="checkbox" id="metodo-contr-{{ $metodoContr->id }}" 
                           name="metodo_contr_filtro[]" value="{{ $metodoContr->id }}">
                    <label for="metodo-contr-{{ $metodoContr->id }}">{{ $metodoContr->metodo }}</label>
                </li>
            @endforeach
        </ul>        
    </x-oportunidades.buscador-filtro-seccion>

    <x-oportunidades.buscador-filtro-seccion titulo="Etapa del procedimiento" key="5">
        <ul class="list-none list-outside pl-0 pb-4 flex flex-col space-y-2 ml-1">
            @foreach($filtros_opciones['etapas_procedimiento'] as $etapaProc)
                <li>
                    <input class="mr-2 border focus:ring-mtv-secondary" 
                           type="checkbox" id="metodo-contr-{{ $etapaProc->id }}" 
                           name="etapas_proc_filtro[]" value="{{ $etapaProc->id }}">
                    <label for="etapas-proc-{{ $etapaProc->id }}">{{ $etapaProc->etapa }}</label>
                </li>
            @endforeach
        </ul>
    </x-oportunidades.buscador-filtro-seccion>

    <x-oportunidades.buscador-filtro-seccion titulo="Estatus contratación" key="6">
        <ul class="list-none list-outside pl-0 pb-4 flex flex-col space-y-2 ml-1">
            @foreach($filtros_opciones['estatus_contratacion'] as $estatusContr)
                <li>
                    <input class="mr-2 border focus:ring-mtv-secondary" 
                           type="checkbox" id="estatus-contr-{{ $estatusContr->id }}" 
                           name="estatus_proc_filtro[]" value="{{ $estatusContr->id }}">
                    <label for="estatus-proc-{{ $estatusContr->id }}">{{ $estatusContr->estatus }}</label>
                </li>
            @endforeach
        </ul>        
    </x-oportunidades.buscador-filtro-seccion>

    <x-oportunidades.buscador-filtro-seccion titulo="Fecha de inicio" key="7" last="true">
        <div class="grid grid-cols-2 grid-rows-2 gap-y-3 gap-x-3 mb-3">
            <button class="border-mtv-secondary font-bold mtv-button-secondary-white">Trimestre 1</button>
            <button class="border-mtv-secondary font-bold mtv-button-secondary-white">Trimestre 2</button>
            <button class="border-mtv-secondary font-bold mtv-button-secondary-white">Trimestre 3</button>
            <button class="border-mtv-secondary font-bold mtv-button-secondary-white">Trimestre 4</button>
        </div>
        <div class="flex flex-row mb-4 text-mtv-text-gray space-x-3">
            <div class="basis-1/2">
                <label for="fecha_inicio">Fecha inicial</label>
                <input type="date" id="fecha_inicio" class="w-full mtv-text-input">
            </div>
            <div class="basis-1/2">
                <label for="fecha_inicio">Fecha final</label>
                <input type="date" id="fecha_inicio" class="w-full mtv-text-input">
            </div>
        </div>
    </x-oportunidades.buscador-filtro-seccion>
</ul>

<div class="flex flex-row space-x-3 items-center justify-center">
    <button class="font-normal mtv-button-secondary-white">Borrar filtros</button>
    <button class="mtv-button-secondary">Aplicar filtros</button>
</div>
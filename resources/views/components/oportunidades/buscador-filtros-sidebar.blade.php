@props(['filtros_opciones' => []])

<form method="POST" x-data="oportunidadesFiltros()"
      @submit="oportunidadesBusquedaRuta = opnRutaCompleta()"
      x-bind:action="oportunidadesBusquedaRuta">
    @csrf
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
            <x-oportunidades.buscador-filtro-unidades-compradoras
                :unidades_compradoras="$filtros_opciones['unidades_compradoras']"
             />
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
                            type="checkbox" id="etapa-proc-{{ $etapaProc->id }}" 
                            name="etapa_proc_filtro[]" value="{{ $etapaProc->id }}">
                        <label for="etapa-proc-{{ $etapaProc->id }}">{{ $etapaProc->etapa }}</label>
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
                            name="estatus_contr_filtro[]" value="{{ $estatusContr->id }}">
                        <label for="estatus-contr-{{ $estatusContr->id }}">{{ $estatusContr->estatus }}</label>
                    </li>
                @endforeach
            </ul>        
        </x-oportunidades.buscador-filtro-seccion>

        <x-oportunidades.buscador-filtro-seccion titulo="Fecha de inicio" key="7" last="true">
            <x-oportunidades.buscador-filtro-fechas />
        </x-oportunidades.buscador-filtro-seccion>
    </ul>

    <div class="flex flex-row space-x-3 items-center justify-center">        
        <button class="font-normal mtv-button-secondary-white">Borrar filtros</button>    
        <button type="submit" class="mtv-button-secondary">
            Aplicar filtros
        </button>
    </div>
</form>

<script type="text/javascript">
    function oportunidadesFiltros() {        
        return {
            oportunidadesBusquedaRuta: @js(route('oportunidades-negocio.search', [request()->get('oportunidades_search')])),            
            opnRutaCompleta() {
                let queryParams = this.queryFiltros();
                if (queryParams !== '') {
                    queryParams = '?' + queryParams;
                }                

                return this.oportunidadesBusquedaRuta + queryParams;
            },
            queryFiltros() {
                const query = new URLSearchParams();                
                this.collectFilter('unidad_compradora_filtro[]', query, 'uc');
                this.collectFilter('capitulo_filtro[]', query, 'ca');
                this.collectFilter('tipo_contr_filtro[]', query, 'tc');
                this.collectFilter('metodo_contr_filtro[]', query, 'mc');
                this.collectFilter('etapa_proc_filtro[]', query, 'ep');
                this.collectFilter('estatus_contr_filtro[]', query, 'ec');

                return query.toString();
            },
            collectFilter(inputName, query, name) {
                const inputs = document.getElementsByName(inputName);
                const inputs_checked = [];
                inputs.forEach(i => { 
                    if (i.checked) {
                        inputs_checked.push(i.value)
                    }                    
                });                
                if (inputs_checked.length > 0) {
                    query.append(name, inputs_checked.join(','));
                }
            }
        }
    }
</script>
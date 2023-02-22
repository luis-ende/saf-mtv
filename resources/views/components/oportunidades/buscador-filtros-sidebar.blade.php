@props(['filtros_opciones' => []])

<form id="filtros-form" method="POST" x-data="oportunidadesFiltros()"
      @submit="oportunidadesBusquedaRuta = opnRutaCompleta()"
      x-bind:action="oportunidadesBusquedaRuta">
    @csrf
    <ul class="bg-white text-mtv-text-gray md:px-7 xs:px-2">
        <x-oportunidades.buscador-filtro-seccion titulo="Grandes rubros de gastos" key="1" :selected="!empty($filtrosActivos['ca'])">
            <ul class="list-none list-outside pl-0 pb-4 flex flex-col space-y-2 ml-1">
                @foreach($filtros_opciones['capitulos'] as $capitulo)
                    <li>
                        <input class="mr-2 border focus:ring-mtv-secondary"
                               type="checkbox" id="capitulo-{{ $capitulo->id }}"
                               name="capitulo_filtro[]" value="{{ $capitulo->id }}"
                               @checked(in_array($capitulo->id, $filtrosActivos['ca']))
                        >
                        <label for="capitulo-{{ $capitulo->id }}">
                            {{ $capitulo->numero }} - {{ $capitulo->nombre }}
                        </label>
                    </li>
                @endforeach
            </ul>
        </x-oportunidades.buscador-filtro-seccion>

        <x-oportunidades.buscador-filtro-seccion titulo="Instituciones compradoras" key="2" :selected="!empty($filtrosActivos['uc'])">
            <x-oportunidades.buscador-filtro-unidades-compradoras
                :unidades_compradoras="$filtros_opciones['unidades_compradoras']"
                :seleccion="$filtrosActivos['uc']"
             />
        </x-oportunidades.buscador-filtro-seccion>

        <x-oportunidades.buscador-filtro-seccion titulo="Tipo de contratación" key="3" :selected="!empty($filtrosActivos['tc'])">
            <ul class="list-none list-outside pl-0 pb-4 flex flex-col space-y-2 ml-1">
                @foreach($filtros_opciones['tipos_contratacion'] as $tipoContr)
                    <li>
                        <input class="mr-2 border focus:ring-mtv-secondary" 
                               type="checkbox" id="tipo-contr-{{ $tipoContr->id }}"
                               name="tipo_contr_filtro[]" value="{{ $tipoContr->id }}"
                               @checked(in_array($tipoContr->id, $filtrosActivos['tc']))
                        >
                        <label for="tipo-contr-{{ $tipoContr->id }}">{{ $tipoContr->tipo }}</label>
                    </li>
                @endforeach
            </ul>        
        </x-oportunidades.buscador-filtro-seccion>

        <x-oportunidades.buscador-filtro-seccion titulo="Método de contratación" key="4" :selected="!empty($filtrosActivos['mc'])">
            <ul class="list-none list-outside pl-0 pb-4 flex flex-col space-y-2 ml-1">
                @foreach($filtros_opciones['metodos_contratacion'] as $metodoContr)
                    <li>
                        <input class="mr-2 border focus:ring-mtv-secondary" 
                               type="checkbox" id="metodo-contr-{{ $metodoContr->id }}"
                               name="metodo_contr_filtro[]" value="{{ $metodoContr->id }}"
                               @checked(in_array($metodoContr->id, $filtrosActivos['mc']))
                        >
                        <label for="metodo-contr-{{ $metodoContr->id }}">{{ $metodoContr->metodo }}</label>
                    </li>
                @endforeach
            </ul>        
        </x-oportunidades.buscador-filtro-seccion>

        <x-oportunidades.buscador-filtro-seccion titulo="Etapa del procedimiento" key="5" :selected="!empty($filtrosActivos['ep'])">
            <ul class="list-none list-outside pl-0 pb-4 flex flex-col space-y-2 ml-1">
                @foreach($filtros_opciones['etapas_procedimiento'] as $etapaProc)
                    <li>
                        <input class="mr-2 border focus:ring-mtv-secondary" 
                               type="checkbox" id="etapa-proc-{{ $etapaProc->id }}"
                               name="etapa_proc_filtro[]" value="{{ $etapaProc->id }}"
                               @checked(in_array($etapaProc->id, $filtrosActivos['ep']))
                        >
                        <label for="etapa-proc-{{ $etapaProc->id }}">{{ $etapaProc->etapa }}</label>
                    </li>
                @endforeach
            </ul>
        </x-oportunidades.buscador-filtro-seccion>

        <x-oportunidades.buscador-filtro-seccion titulo="Estatus contratación" key="6" :selected="!empty($filtrosActivos['ec'])">
            <ul class="list-none list-outside pl-0 pb-4 flex flex-col space-y-2 ml-1">
                @foreach($filtros_opciones['estatus_contratacion'] as $estatusContr)
                    <li>
                        <input class="mr-2 border focus:ring-mtv-secondary" 
                            type="checkbox" id="estatus-contr-{{ $estatusContr->id }}" 
                            name="estatus_contr_filtro[]" value="{{ $estatusContr->id }}"
                            @checked(in_array($estatusContr->id, $filtrosActivos['ec']))
                        >
                        <label for="estatus-contr-{{ $estatusContr->id }}">{{ $estatusContr->estatus }}</label>
                    </li>
                @endforeach
            </ul>        
        </x-oportunidades.buscador-filtro-seccion>

        <x-oportunidades.buscador-filtro-seccion titulo="Fecha de inicio" key="7" last="true"
            :selected="!empty($filtroFechaInicio) || !empty($filtroFechaFinal) || !empty($filtroTrimestre)"
        >
            <x-oportunidades.buscador-filtro-fechas
                    :filtro_fi="$filtroFechaInicio"
                    :filtro_ff="$filtroFechaFinal"
                    :filtro_trimestre="$filtroTrimestre"
            />
        </x-oportunidades.buscador-filtro-seccion>
    </ul>

    <div :class="{'fixed bottom-0 left-0 bg-white w-full border-t-2': filtrosModalOpen}"
         class="flex flex-row space-x-3 items-center justify-center">
        <button type="submit" class="font-normal mtv-button-secondary-white" @click="limpiaFiltros()">Borrar filtros</button>
        <button type="submit" class="mtv-button-secondary">Aplicar filtros</button>
    </div>
</form>

@push('scripts')
<script type="text/javascript">
    function oportunidadesFiltros() {        
        return {            
            oportunidadesBusquedaRuta: @js(route('oportunidades-negocio.search')),
            limpiaFiltro: false,
            opnRutaCompleta() {
                if (!this.limpiaFiltro) {
                    let queryParams = this.$data.queryFiltros();
                    if (queryParams !== '') {
                        queryParams = '?' + queryParams;
                    }

                    return this.oportunidadesBusquedaRuta + queryParams + '#seccion-principal';
                }

                return this.oportunidadesBusquedaRuta;
            },            
            limpiaFiltros() {
                this.limpiaFiltro = true;
                const inputs = document.querySelectorAll('#filtros-form input');
                inputs.forEach(input => {
                    if (input.name !== '_token') {
                        if (input.type === 'checkbox') {
                            input.checked = false;
                        }
                        input.value = null;
                    }
                });
            },            
        }
    }
</script>
@endpush
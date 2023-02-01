@props(['filtros_opciones' => []])
<form method="POST"         
      action="{{ route('oportunidades-negocio.search', [request()->get('oportunidades_search')]) }}">
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
                            type="checkbox" id="metodo-contr-{{ $etapaProc->id }}" 
                            name="etapa_proc_filtro[]" value="{{ $etapaProc->id }}">
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
                            name="estatus_contr_filtro[]" value="{{ $estatusContr->id }}">
                        <label for="estatus-proc-{{ $estatusContr->id }}">{{ $estatusContr->estatus }}</label>
                    </li>
                @endforeach
            </ul>        
        </x-oportunidades.buscador-filtro-seccion>

        <x-oportunidades.buscador-filtro-seccion titulo="Fecha de inicio" key="7" last="true">
            <div class="grid grid-cols-2 grid-rows-2 gap-y-3 gap-x-3 mb-3" x-data="{
                trimestres: { 1: '0', 2: '0', 3: '0', 4: '0', },                
                trimestreActivo: 'font-bold text-white bg-mtv-secondary focus:ring-0 active:ring-0 rounded-lg py-1',
                trimestreInactivo: 'font-bold text-mtv-secondary bg-white focus:ring-0 active:ring-0 border-2 border-mtv-secondary rounded-lg py-1',
                setTrimestre(numTrimestre) {
                    Object.keys(this.trimestres).forEach(key => this.trimestres[key] = '0');
                    this.trimestres[numTrimestre] = '1';
                },
                getTrimestreEstilo(numTrimestre) {
                    return this.trimestres[numTrimestre] === '1' ? this.trimestreActivo : this.trimestreInactivo;
                }
            }">
                <button type="button" 
                        :class="getTrimestreEstilo(1)" 
                        @click.prevent="setTrimestre(1)">
                    Trimestre 1
                </button>
                <input type="hidden" id="fecha_trimestre1_filtro" name="fecha_trimestre1_filtro" x-model="trimestres[1]">
                <button type="button" 
                        :class="getTrimestreEstilo(2)" 
                        @click.prevent="setTrimestre(2)">
                    Trimestre 2
                </button>
                <input type="hidden" id="fecha_trimestre2_filtro" name="fecha_trimestre2_filtro" x-model="trimestres[2]">
                <button type="button" 
                        :class="getTrimestreEstilo(3)" 
                        @click.prevent="setTrimestre(3)">
                    Trimestre 3
                </button>
                <input type="hidden" id="fecha_trimestre3_filtro" name="fecha_trimestre3_filtro" x-model="trimestres[3]">
                <button type="button" 
                        :class="getTrimestreEstilo(4)" 
                        @click.prevent="setTrimestre(4)">
                    Trimestre 4
                </button>
                <input type="hidden" id="fecha_trimestre4_filtro" name="fecha_trimestre4_filtro" x-model="trimestres[4]">
            </div>
            <div class="flex flex-row mb-4 text-mtv-text-gray space-x-3">
                <div class="basis-1/2">
                    <label for="fecha_inicio">Fecha inicial</label>
                    <input type="date" id="fecha_inicio_filtro" name="fecha_inicio_filtro" class="w-full mtv-text-input">
                </div>
                <div class="basis-1/2">
                    <label for="fecha_final">Fecha final</label>
                    <input type="date" id="fecha_final_filtro" name="fecha_final_filtro" class="w-full mtv-text-input">
                </div>
            </div>
        </x-oportunidades.buscador-filtro-seccion>
    </ul>

    <div class="flex flex-row space-x-3 items-center justify-center">        
        <button class="font-normal mtv-button-secondary-white">Borrar filtros</button>    
        <button type="submit" class="mtv-button-secondary">
            Aplicar filtros
        </button>    
    </div>
</form>
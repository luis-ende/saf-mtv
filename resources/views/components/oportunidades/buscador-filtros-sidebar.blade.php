@props(['filtros_opciones' => []])

<ul class="bg-white text-mtv-text-gray">
    <x-oportunidades.buscador-filtro-seccion titulo="Rubro de gasto">
        <ul class="list-none list-outside pb-4 flex flex-col space-y-2">
            @foreach($filtros_opciones['capitulos'] as $capitulo)
                <li>
                    <input class="mr-2 border focus:ring-mtv-secondary" type="checkbox" id="capitulo-{{ $capitulo }}" name="capitulo_filtro[]" value="{{ $capitulo }}">
                    <label for="capitulo-{{ $capitulo }}">{{ $capitulo }}</label>
                </li>
            @endforeach
        </ul>
    </x-oportunidades.buscador-filtro-seccion>

    <x-oportunidades.buscador-filtro-seccion titulo="Instituciones compradoras">
        Item 2
    </x-oportunidades.buscador-filtro-seccion>

    <x-oportunidades.buscador-filtro-seccion titulo="Tipo de contratación">        
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

    <x-oportunidades.buscador-filtro-seccion titulo="Método de contratación">
        Item 4
    </x-oportunidades.buscador-filtro-seccion>

    <x-oportunidades.buscador-filtro-seccion titulo="Etapa del procedimiento">
        Item 5
    </x-oportunidades.buscador-filtro-seccion>

    <x-oportunidades.buscador-filtro-seccion titulo="Estatus contratación">
        Item 6
    </x-oportunidades.buscador-filtro-seccion>

    <x-oportunidades.buscador-filtro-seccion titulo="Fecha de inicio">
        Item 7
    </x-oportunidades.buscador-filtro-seccion>



    {{-- <li class="relative border-b border-gray-200" x-data="{ selected: null }">
        <button type="button" class="w-full px-8 py-6 text-left" @click="selected !== 1 ? selected = 1 : selected = null">
            <div class="flex items-center justify-between">
                <span>
                    Rubro de gasto
                </span>                    
                @svg('ri-arrow-drop-up-line', ['x-show' => 'selected === 1', 'class' => 'w-7 h-7'])
                @svg('ri-arrow-drop-down-line', ['x-show' => 'selected !== 1', 'class' => 'w-7 h-7'])                    
            </div>
        </button>

        <div class="relative overflow-hidden transition-all max-h-0 duration-200" 
            style="" x-ref="container1" x-bind:style="selected == 1 ? 'max-height: ' + $refs.container1.scrollHeight + 'px' : ''">
            <div class="p-6">
                Item 1
            </div>
        </div>
    </li>
 --}}

    {{-- <li class="relative border-b border-gray-200" x-data="{selected:null}">

        <button type="button" class="w-full px-8 py-6 text-left" @click="selected !== 2 ? selected = 2 : selected = null">
            <div class="flex items-center justify-between">
                <span>
                    Instituciones compradoras
                </span>
                @svg('ri-arrow-drop-up-line', ['x-show' => 'selected === 2', 'class' => 'w-7 h-7'])
                @svg('ri-arrow-drop-down-line', ['x-show' => 'selected !== 2', 'class' => 'w-7 h-7'])                                        
            </div>
                        </button>

        <div class="relative overflow-hidden transition-all max-h-0 duration-200" style="" x-ref="container2" x-bind:style="selected == 2 ? 'max-height: ' + $refs.container2.scrollHeight + 'px' : ''">
            <div class="p-6">
                Item 2
            </div>
        </div>

    </li> --}}


    {{-- <li class="relative border-b border-gray-200" x-data="{selected:null}">
        <button type="button" class="w-full px-8 py-6 text-left" @click="selected !== 3 ? selected = 3 : selected = null">
            <div class="flex items-center justify-between">
                <span>
                    Tipo de contratación
                </span>
                @svg('ri-arrow-drop-up-line', ['x-show' => 'selected === 3', 'class' => 'w-7 h-7'])
                @svg('ri-arrow-drop-down-line', ['x-show' => 'selected !== 3', 'class' => 'w-7 h-7'])                                        
            </div>
        </button>
        <div class="relative overflow-hidden transition-all max-h-0 duration-200" style="" x-ref="container3" x-bind:style="selected == 3 ? 'max-height: ' + $refs.container3.scrollHeight + 'px' : ''">
            <div class="p-6">
                Item 3
            </div>
        </div>
    </li> --}}

    {{-- <li class="relative border-b border-gray-200" x-data="{selected:null}">
        <button type="button" class="w-full px-8 py-6 text-left" @click="selected !== 3 ? selected = 3 : selected = null">
            <div class="flex items-center justify-between">
                <span>
                    Método de contratación
                </span>
                @svg('ri-arrow-drop-up-line', ['x-show' => 'selected === 3', 'class' => 'w-7 h-7'])
                @svg('ri-arrow-drop-down-line', ['x-show' => 'selected !== 3', 'class' => 'w-7 h-7'])                                        
            </div>
        </button>
        <div class="relative overflow-hidden transition-all max-h-0 duration-200" style="" x-ref="container3" x-bind:style="selected == 3 ? 'max-height: ' + $refs.container3.scrollHeight + 'px' : ''">
            <div class="p-6">
                Item 3
            </div>
        </div>
    </li> --}}

    {{-- <li class="relative border-b border-gray-200" x-data="{selected:null}">
        <button type="button" class="w-full px-8 py-6 text-left" @click="selected !== 3 ? selected = 3 : selected = null">
            <div class="flex items-center justify-between">
                <span>
                    Etapa del procedimiento
                </span>
                @svg('ri-arrow-drop-up-line', ['x-show' => 'selected === 3', 'class' => 'w-7 h-7'])
                @svg('ri-arrow-drop-down-line', ['x-show' => 'selected !== 3', 'class' => 'w-7 h-7'])                                        
            </div>
        </button>
        <div class="relative overflow-hidden transition-all max-h-0 duration-200" style="" x-ref="container3" x-bind:style="selected == 3 ? 'max-height: ' + $refs.container3.scrollHeight + 'px' : ''">
            <div class="p-6">
                Item 3
            </div>
        </div>
    </li>

    <li class="relative border-b border-gray-200" x-data="{selected:null}">
        <button type="button" class="w-full px-8 py-6 text-left" @click="selected !== 3 ? selected = 3 : selected = null">
            <div class="flex items-center justify-between">
                <span>
                    Estatus contratación
                </span>
                @svg('ri-arrow-drop-up-line', ['x-show' => 'selected === 3', 'class' => 'w-7 h-7'])
                @svg('ri-arrow-drop-down-line', ['x-show' => 'selected !== 3', 'class' => 'w-7 h-7'])                                        
            </div>
        </button>
        <div class="relative overflow-hidden transition-all max-h-0 duration-200" style="" x-ref="container3" x-bind:style="selected == 3 ? 'max-height: ' + $refs.container3.scrollHeight + 'px' : ''">
            <div class="p-6">
                Item 3
            </div>
        </div>
    </li> --}}

    {{-- <li class="relative border-b border-gray-200" x-data="{selected:null}">
        <button type="button" class="w-full px-8 py-6 text-left" @click="selected !== 3 ? selected = 3 : selected = null">
            <div class="flex items-center justify-between">
                <span>
                    Fecha de inicio
                </span>
                @svg('ri-arrow-drop-up-line', ['x-show' => 'selected === 3', 'class' => 'w-7 h-7'])
                @svg('ri-arrow-drop-down-line', ['x-show' => 'selected !== 3', 'class' => 'w-7 h-7'])                                        
            </div>
        </button>
        <div class="relative overflow-hidden transition-all max-h-0 duration-200" style="" x-ref="container3" x-bind:style="selected == 3 ? 'max-height: ' + $refs.container3.scrollHeight + 'px' : ''">
            <div class="p-6">
                Item 3
            </div>
        </div>
    </li> --}}
</ul>    
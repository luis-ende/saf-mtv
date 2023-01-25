@props(['categorias' => []])

<div class="accordion" id="oportunidades-accordion">
    @foreach($categorias as $categoria => $oportunidades)
    <div class="accordion-item">
        <h2 class="accordion-header" id="heading-oportunidad-{{ $loop->index }}">
            <button class="accordion-button fw-bold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#body-oportunidad-{{ $loop->index }}" aria-expanded="true" aria-controls="body-oportunidad-{{ $loop->index }}">
                {{ $categoria }} ({{ count($oportunidades) }} Procedimiento{{ count($oportunidades) > 1 ? 's' : '' }})
            </button>
        </h2>
        <div id="body-oportunidad-{{ $loop->index }}" 
            class="accordion-collapse collapse" 
            aria-labelledby="heading-oportunidad-{{ $loop->index }}" 
            data-bs-parent="#oportunidades-accordion">
            <div class="accordion-body flex flex-col space-y-4">
                @foreach($oportunidades as $oportunidad)
                    <x-field-group-card title="{{ $oportunidad['nombre_procedimiento'] }}">
                        <div class="w-full p-2 flex flex-col">
                            <div class="flex flex-row">
                                <div class="basis-10/12 text-mtv-text-gray text-base flex flex-col space-y-1">
                                    <span>Fecha de publicación: <span class="font-bold">{{ $oportunidad['fecha_publicacion'] }}</span></span>
                                    <span>Presentación de propuestas: <span class="font-bold">{{ $oportunidad['fecha_presentacion_propuestas'] }}</span></span>
                                    <span>Tipo de contratación: <span class="font-bold">{{ $oportunidad['tipo_contratacion'] }}</span></span>
                                    <span>Modo de contratación: <span class="font-bold">{{ $oportunidad['metodo_contratacion'] }}</span></span>
                                    <span>Rubro de gasto: <span class="font-bold">-</span></span>
                                </div>
                                <div class="basis-2/12 text-mtv-text-gray text-base flex flex-col">
                                    <span class="bg-[Green] opacity-50 rounded-tl-lg rounded-br-lg text-white font-bold text-center py-1 px-2">En proceso</span>
                                </div>
                            </div>                            
                            <div class="basis-full flex flex-row items-center space-x-4 mt-4 mb-2">
                                <span class="bg-mtv-gold text-white font-bold rounded py-1 px-3">Programado para compra</span>
                                <span class="bg-white text-mtv-gold border-mtv-gold border-2 rounded-lg font-bold py-1 px-3">Prebases</span>
                                <span class="bg-white text-mtv-gold border-mtv-gold border-2 rounded-lg font-bold py-1 px-3">Licitación en proceso</span>
                                <span class="bg-white text-mtv-gold border-mtv-gold border-2 rounded-lg font-bold py-1 px-3">Pre-cotizar</span>
                            </div>                            
                            <x-slot name="footer">
                                <div class="flex flex-row justify-center mx-3 py-1">
                                    <button type="button" class="mtv-button-secondary">
                                        @svg('codicon-bell-dot', ['class' => 'h-5 w-5 inline-block mr-2 cursor-pointer'])
                                        Activar alerta
                                    </button>
                                </div>
                            </x-slot>    
                        </div>                        
                    </x-field-group-card>                    
                @endforeach
            </div>
        </div>
    </div>
    @endforeach
</div>

<div class="flex flex-col flex-nowrap">
    <div class="py-3 bg-mtv-primary px-3 flex flex-row flex-nowrap font-bold md:text-base xs:text-sm h-14">
        @php($currentRoute = Route::current()->getName())                
        @if(!in_array($currentRoute, ['catalogo-registro-inicio', 'importacion-productos-1.show', 'importacion-productos-2.show', 'importacion-productos-3.show']))
            <a href="#"
                onclick="history.back()"
                class="text-mtv-gold-light no-underline hover:text-white flex flex-row">
                @svg('fas-arrow-left', ['class' => 'md:h-7 md:w-7 xs:h-5 xs:w-5 inline-block mr-3'])
                Regresar
            </a>        
        @endif
        
    </div>
    <div class="w-full h-3 bg-mtv-gold-light"></div>
    <div class="text-2xl py-1 px-7 bg-white border-b border-gray-200 flex flex-row my-3">
        <div class="basis-full">
            <div class="font-bold text-2xl text-mtv-primary flex flex-col">
                @if(isset($texto_secuencia))
                    <div class="basis-1/5">
                        @isset($titulo_icono)
                            @svg($titulo_icono, ['class' => 'h-5 w-5 inline-block mr-3'])
                        @endisset    
                        {{ $titulo }}
                    </div>           
                    <div class="basis-4/5 text-mtv-gold mb-3 text-center">
                        {{ $texto_secuencia }}
                    </div>     
                @else
                    <div class="basis-full mb-3">
                        {{ $titulo }}
                    </div>           
                @endif                
            </div>
            <div class="xs:text-base md:text-lg tracking-wide text-mtv-text-gray">
                {{ $subtitulo }}
            </div>
        </div>        
    </div>
</div>
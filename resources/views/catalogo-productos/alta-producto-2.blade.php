<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-4">
        <div class="bg-white overflow-hidden shadow-sm">
            @include('catalogo-productos.registro-header',
                       ['titulo' => '',                        
                        'subtitulo' => '',
                        'texto_secuencia' => 'Paso 2 de 4'])            
            @php($tipoProducto = session()->get('tipo_producto'))
            <form method="POST" action="{{ route('alta-producto.store', [2, request()->producto]) }}" class="px-6">
                @csrf
                <div class="mx-auto flex flex-col w-1/2">                       
                    <label class="block basis-full text-xl font-bold text-mtv-secondary mt-2 mb-2 self-center">
                        Describe tu producto
                    </label>                 
                    <div class="mtv-input-wrapper">
                        <input type="text" class="mtv-text-input" id="nombre" name="nombre"
                               value="" required>
                        <label class="mtv-input-label" for="nombre">Nombre de tu producto</label>
                    </div>
                    <label class="text-xs text-slate-500 mx-3 italic" 
                           for="descripcion_producto">
                           Aparecerá como título en el catálogo
                    </label>
                    <div class="mtv-input-wrapper">
                        <textarea class="mtv-text-input" id="descripcion"
                                name="descripcion" maxlength="140"></textarea>
                        <label class="mtv-input-label" for="descripcion">Describe tu producto</label>                        
                    </div>
                    <label class="text-xs text-slate-500 mx-3 italic" 
                               for="producto">
                               Indica en qué unidad de medida vendes tu producto, qué presentación tiene, fabricante y otras características importantes con las que cuenta tu producto.
                    </label>  
                    @if($tipoProducto === 'B')                  
                        <div class="md:grid md:grid-cols-2 md:gap-2">
                            <div class="mtv-input-wrapper">
                                <input type="text" class="mtv-text-input" id="marca" name="marca"
                                        value="">
                                <label class="mtv-input-label" for="marca">Marca</label>
                            </div>
                            <div class="mtv-input-wrapper">
                                <input type="text" class="mtv-text-input" id="modelo" name="modelo"
                                    value="">
                                <label class="mtv-input-label" for="modelo">Modelo o SKU</label>
                            </div>
                            <div>
                                <div class="mtv-input-wrapper">
                                    <input type="text" class="mtv-text-input" id="color" name="color"
                                        value="">
                                    <label class="mtv-input-label" for="color">Color(es)</label>
                                </div>
                                <label class="text-xs text-slate-500 mx-3" 
                                for="color">
                                Usa comas para separar las palabras
                                </label>                        
                            </div>                        
                            <div>
                                <div class="mtv-input-wrapper">
                                    <input type="text" class="mtv-text-input" id="material" name="material"
                                        value="">
                                    <label class="mtv-input-label" for="material">Material</label>
                                </div>
                                <label class="text-xs text-slate-500" 
                                for="color">                               
                                </label>                        
                            </div>
                            <div class="mtv-input-wrapper">
                                <input type="text" class="mtv-text-input" id="codigo_barras" name="codigo_barras"
                                    value="">
                                <label class="mtv-input-label" for="material">Código de barras</label>
                            </div>
                        </div>
                    @endif    
                    <button type="submit" 
                            class="mtv-button-secondary self-center my-4">
                            Siguiente
                    </button>
                </div>                                
            </form>
        </div>
    </div>
</x-app-layout>

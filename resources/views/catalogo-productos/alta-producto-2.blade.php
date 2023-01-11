<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-4">
        <div class="bg-white overflow-hidden shadow-sm">
            @include('catalogo-productos.registro-header',
                       ['titulo' => '',                        
                        'subtitulo' => '',
                        'texto_secuencia' => 'Paso 2 de 4'])            
            @php($productoId = $producto->id)
            @php($tipoProducto = $producto->tipo)
            @php($nombre = $producto->registro_fase >= 2 ? $producto->nombre : '' )
            @php($descripcion = $producto->registro_fase >= 2 ? $producto->descripcion : '' )
            @php($marca = $producto->registro_fase >= 2 ? $producto->marca : '' )
            @php($modelo = $producto->registro_fase >= 2 ? $producto->modelo : '' )
            @php($material = $producto->registro_fase >= 2 ? $producto->material : '' )
            @php($codigoBarras = $producto->registro_fase >= 2 ? $producto->codigo_barras : '' )
            @php($productoColor = $producto->registro_fase >= 2 ? $producto->color : '')
            <form method="POST" action="{{ route('alta-producto.store', [2, $productoId]) }}" class="px-6">
                @csrf
                <div class="mx-auto flex flex-col w-1/2">                       
                    <label class="block basis-full text-xl font-bold text-mtv-secondary mt-2 mb-2 self-center">
                        Describe tu producto
                    </label>                 
                    <label class="text-mtv-gray text-base mb-3 self-center">
                        Los campos marcados con <span class="text-mtv-primary">*</span> son obligatorios.
                    </label>
                    <div class="mtv-input-wrapper">
                        <input type="text" class="mtv-text-input" id="nombre" name="nombre"
                               value="{{ $nombre }}" required>
                        <label class="mtv-input-label" for="nombre">Nombre de tu producto<span class="text-mtv-primary">*</span></label>
                    </div>
                    <label class="text-xs text-slate-500 mx-3 italic" 
                           for="descripcion_producto">
                           Aparecerá como título en el catálogo
                    </label>
                    <div class="mtv-input-wrapper">
                        <textarea class="mtv-text-input" id="descripcion"                                  
                                  name="descripcion" maxlength="140" required>{{ $descripcion }}</textarea>
                        <label class="mtv-input-label" for="descripcion">Describe tu producto<span class="text-mtv-primary">*</span></label>                        
                    </div>
                    <label class="text-xs text-slate-500 mx-3 italic" 
                           for="producto">
                               Indica en qué unidad de medida vendes tu producto, qué presentación tiene, fabricante y otras características importantes con las que cuenta tu producto.
                    </label>  
                    @if($tipoProducto === 'B')                  
                        <div class="md:grid md:grid-cols-2 md:gap-2">
                            <div class="mtv-input-wrapper">
                                <input type="text" class="mtv-text-input" id="marca" name="marca"
                                        value="{{ $marca }}">
                                <label class="mtv-input-label" for="marca">Marca</label>
                            </div>
                            <div class="mtv-input-wrapper">
                                <input type="text" class="mtv-text-input" id="modelo" name="modelo"
                                    value="{{ $modelo }}">
                                <label class="mtv-input-label" for="modelo">Modelo o SKU</label>
                            </div>
                            
                            <x-input-producto-color-select
                                :producto_colores="$productoColor"
                             />
                                                        
                            <div class="mtv-input-wrapper">
                                <input type="text" class="mtv-text-input" id="material" name="material"
                                    value="{{ $material }}">
                                <label class="mtv-input-label" for="material">Material</label>
                            </div>                                                            
                            <div class="mtv-input-wrapper">
                                <input type="text" class="mtv-text-input" id="codigo_barras" name="codigo_barras"
                                       value="{{ $codigoBarras }}">
                                <label class="mtv-input-label" for="material">Código de barras</label>
                            </div>
                        </div>
                    @endif    
                    <div class="flex flex-row my-4 space-x-10 justify-center">
                        <a href="{{ route('alta-producto-1.show', [$productoId]) }}" 
                            class="mtv-button-secondary-white no-underline self-center">
                            @svg('fas-arrow-left', ['class' => 'h-7 w-7 inline-block'])
                            Atrás
                        </a>
                        <button type="submit" 
                                class="mtv-button-secondary self-center my-4">
                                Siguiente
                        </button>
                    </div>
                </div>                                
            </form>
        </div>
    </div>
</x-app-layout>

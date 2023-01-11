@props(['producto' => null])

<div class="flex md:flex-row xs:flex-col md:space-x-5"
     @role('proveedor')
     x-data="busquedaCABMS"
     x-init="initBusquedaCABMS()"
     @endrole
     >     
    <div class="md:basis-4/12 xs:basis-full mb-3">        
        <div class="flex flex-col space-y-3">
            <div class="basis-full border rounded">
                @if(isset($producto->fotos_info[0]))
                    <img class="object-cover w-80 h-80 mx-auto my-6" 
                        src="{{ isset($producto->fotos_info[0]) ? $producto->fotos_info[0]->original_url : '' }}">
                @else
                    @svg('ri-image-fill', ['class' => 'text-mtv-gray-light w-80 h-80 inline-block'])
                @endif                
            </div>
            <div class="basis-full flex flex-row space-x-5">
                <div class="basis-1/2 border rounded">
                    @if(isset($producto->fotos_info[1]))
                        <img class="object-cover w-24 h-24 mx-auto my-3" 
                             src="{{ isset($producto->fotos_info[1]) ? $producto->fotos_info[1]->original_url : '' }}">
                    @else
                        @svg('ri-image-fill', ['class' => 'text-mtv-gray-light w-24 h-24 mx-auto'])
                    @endif                    
                </div>
                <div class="basis-1/2 border rounded">
                    @if(isset($producto->fotos_info[2]))
                        <img class="object-cover w-24 h-24 mx-auto my-3" 
                             src="{{ isset($producto->fotos_info[2]) ? $producto->fotos_info[1]->original_url : '' }}">
                    @else
                        @svg('ri-image-fill', ['class' => 'text-mtv-gray-light w-24 h-24 mx-auto'])
                    @endif                    
                </div>
            </div>
        </div>
    </div>
    <div class="md:basis-8/12 xs:basis-full" 
         @role('proveedor')
         x-data="productoInfo()"
         @endrole
         >
        <p class="text-mtv-primary text-lg font-bold">{{ $producto->nombre }}</p>
        <label class="text-mtv-primary font-bold my-2">Categoría</label>
        <table class="mb-4">
            <tr class="border-b border-t">
                <td class="text-mtv-gray-2 py-1">Partida</td>
                <td class="text-mtv-text-gray py-1 pl-3">{{ $producto->partida }}</td>
            </tr>
            <tr class="border-b">
                <td class="text-mtv-gray-2 py-1">Clave CABMS</td>
                <td class="text-mtv-text-gray py-1 pl-3">{{ $producto->cabms }}</td>
            </tr>
            <tr class="border-b">
                <td class="text-mtv-gray-2 py-1">Categoría(s)</td>
                <td class="text-mtv-text-gray py-1 pl-3 uppercase">{{ $producto->categorias_scian }}</td>
            </tr>
            <tr class="border-b">
                <td class="text-mtv-gray-2 py-1">Nombre catálogo CDMX</td>
                <td class="text-mtv-text-gray py-1 pl-3">{{ $producto->nombre_cabms }}</td>
            </tr>
        </table>

        <label class="text-mtv-primary font-bold my-2">Características</label>
        <table class="mb-4">
            <tr class="border-b border-t">
                <td class="text-mtv-gray-2">Marca</td>
                <td class="text-mtv-text-gray pl-3">{{ $producto->marca }}</td>
            </tr>
            <tr class="border-b">
                <td class="text-mtv-gray-2">Modelo o SKU</td>
                <td class="text-mtv-text-gray pl-3">{{ $producto->modelo }}</td>
            </tr>
            <tr class="border-b">
                <td class="text-mtv-gray-2">Colores</td>
                <td class="text-mtv-text-gray pl-3">
                    @php($colores = !empty($producto->color) ? explode(',', $producto->color) : [] )
                    @foreach($colores as $color)
                        <span class="w-5 h-5 mt-2 inline-block border rounded-xl" 
                             style="background-color: {{ $color }}"></span>
                    @endforeach                    
                </td>
            </tr>
            <tr class="border-b">
                <td class="text-mtv-gray-2">Material</td>
                <td class="text-mtv-text-gray pl-3">{{ $producto->material }}</td>
            </tr>
            <tr class="border-b">
                <td class="text-mtv-gray-2">Código de barras</td>
                <td class="text-mtv-text-gray pl-3">{{ $producto->codigo_barras }}</td>
            </tr>
        </table>

        <label class="text-mtv-primary font-bold my-2">Descripción</label>
        <table class="mb-4 w-1/2">
            <tr class="border-b border-t">
                <td class="text-mtv-text-gray">{{ $producto->descripcion }}</td>
            </tr>
        </table>

        <div class="flex flex-row">           
            <div class="basis-1/2 text-mtv-gold">  
                @if($producto->ficha_tecnica)                    
                    <a href="{{ $producto->ficha_tecnica->original_url }}"
                       class="mtv-link-download-gold"
                       download>
                        @svg('carbon-document-download', ['class' => 'w-7 h-7 inline-block'])
                        {{ $producto->ficha_tecnica->file_name }}
                    </a>
                @endif
            </div>
            <div class="basis-1/2">  
                @if($producto->otro_documento)                    
                    <a href="{{ $producto->otro_documento->original_url }}"
                       class="mtv-link-download-gold"
                       download>
                        @svg('carbon-document-download', ['class' => 'w-7 h-7 inline-block'])
                        {{ $producto->otro_documento->file_name }}
                    </a>
                @endif
            </div>
        </div>

        @role('proveedor')
            <!-- Modal -->
            <div class="modal fade" id="productoModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="productoModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-mtv-gray-light">
                            <h5 class="modal-title" id="productoModalLabel">Editar producto</h5>
                            <button type="button" class="btn-close" @click="editFormClose()" aria-label="Close"></button>
                        </div>
                        <div id="productoFormContainer" class="modal-body px-4">
                            <form id="productoForm">
                                <x-cabms-categorias-select />

                                <div class="mtv-input-wrapper">
                                    <input type="text" class="mtv-text-input" id="nombre" name="nombre"
                                        value="{{ $producto->nombre }}" required>
                                    <label class="mtv-input-label" for="nombre">Nombre de tu producto<span class="text-mtv-primary">*</span></label>
                                </div>
                                <label class="text-xs text-slate-500 mx-3 italic" 
                                    for="descripcion_producto">
                                    Aparecerá como título en el catálogo
                                </label>
                                <div class="mtv-input-wrapper">
                                    <textarea class="mtv-text-input" id="descripcion"                                  
                                            name="descripcion" maxlength="140" required>{{ $producto->descripcion }}</textarea>
                                    <label class="mtv-input-label" for="descripcion">Describe tu producto<span class="text-mtv-primary">*</span></label>                        
                                </div>
                                <label class="text-xs text-slate-500 mx-3 italic" 
                                    for="producto">
                                        Indica en qué unidad de medida vendes tu producto, qué presentación tiene, fabricante y otras características importantes con las que cuenta tu producto.
                                </label>  
                                @if($producto->tipo === 'B')                  
                                    <div class="md:grid md:grid-cols-2 md:gap-2">
                                        <div class="mtv-input-wrapper">
                                            <input type="text" class="mtv-text-input" id="marca" name="marca"
                                                    value="{{ $producto->marca }}">
                                            <label class="mtv-input-label" for="marca">Marca</label>
                                        </div>
                                        <div class="mtv-input-wrapper">
                                            <input type="text" class="mtv-text-input" id="modelo" name="modelo"
                                                value="{{ $producto->modelo }}">
                                            <label class="mtv-input-label" for="modelo">Modelo o SKU</label>
                                        </div>
                                        
                                        <x-input-producto-color-select
                                            :producto_colores="$producto->productoColor"
                                        />
                                                                    
                                        <div class="mtv-input-wrapper">
                                            <input type="text" class="mtv-text-input" id="material" name="material"
                                                value="{{ $producto->material }}">
                                            <label class="mtv-input-label" for="material">Material</label>
                                        </div>                                                            
                                        <div class="mtv-input-wrapper">
                                            <input type="text" class="mtv-text-input" id="codigo_barras" name="codigo_barras"
                                                value="{{ $producto->codigoBarras }}">
                                            <label class="mtv-input-label" for="material">Código de barras</label>
                                        </div>
                                    </div>
                                @endif  

                                <label class="block basis-full text-xl font-bold text-mtv-secondary mt-2 mb-2 self-center">
                                    Fotografías
                                </label>
                                <label class="text-mtv-gray text-base mb-3 self-center">
                                    Hasta <span class="text-lg font-bold">3</span> imágenes de tu producto en formato jpg o png y de hasta 1 MB cada una.
                                </label>
                                <x-producto-fotos-upload />

                                <label class="block basis-full text-xl font-bold text-mtv-secondary mt-2 mb-2 self-center">
                                    Ficha técnica
                                </label>
                                <label class="text-mtv-gray text-base mb-3 self-center">
                                    Adjunta tu documento en formato PDF de hasta 3MB.
                                </label>
                                <x-input-upload
                                    :name="__('ficha_tecnica_file')"
                                    :id="__('ficha_tecnica_file')"
                                />
                                <label class="block basis-full text-xl font-bold text-mtv-secondary mt-2 mb-2 self-center">
                                    Otro documento
                                </label>
                                <label class="text-mtv-gray text-base mb-3 self-center">
                                    Por ejemplo: certificados , manual de uso, entre otros.
                                </label>
                                <x-input-upload
                                    :name="__('otro_documento_file')"
                                    :id="__('otro_documento_file')"
                                    :allow_delete="true"
                                />
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="mtv-button-secondary" @click="guardaProducto(productoEditado)">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>

            <script type="text/javascript">
                function productoInfo() {        
                    return {
                        productoEditado: null,
                        productoModalForm: new bootstrap.Modal(document.getElementById('productoModal'), { keyboard: true }),
                        editFormClose() {
                            this.productoEditado = null;
                            this.productoModalForm.hide();
                        },
                    }
                }
            </script>
        @endrole
    </div>
</div>
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
                    @svg('ri-image-fill', ['class' => 'text-mtv-gray-light w-80 h-80 mx-auto'])
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
                             src="{{ isset($producto->fotos_info[2]) ? $producto->fotos_info[2]->original_url : '' }}">
                    @else
                        @svg('ri-image-fill', ['class' => 'text-mtv-gray-light w-24 h-24 mx-auto'])
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="md:basis-8/12 xs:basis-full"
         @role('proveedor')
         x-init="initProductoInfo()"
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
                <td class="text-mtv-text-gray">
                    @php($descripcionLineas = explode("\n", $producto->descripcion))
                    @if(count($descripcionLineas) > 1)
                        <ul class="list-disc list-outside">
                            @foreach($descripcionLineas as $linea)
                                <li>{{ $linea }}</li>
                            @endforeach
                        </ul>
                    @else
                        {{ $producto->descripcion }}
                    @endif
                </td>
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
                            <form id="productoForm"
                                  method="POST"
                                  enctype="multipart/form-data"
                                  action="{{ route('productos.update', [$producto->id]) }}">
                                @csrf

                                <x-field-group-card title="Descripción">
                                    <x-cabms-categorias-select
                                        modo="producto_edicion"
                                    />

                                    <x-producto-nombre-input
                                        :value="$producto->nombre" />

                                    <x-producto-descripcion-textarea
                                        :value="$producto->descripcion" />

                                    <x-producto-bien-inputs
                                        :producto="$producto" />
                                </x-field-group-card>

                                <br>
                                <x-field-group-card title="Fotografías">
                                    <x-producto-fotos-upload size="compact" />
                                </x-field-group-card>

                                <br>
                                <x-field-group-card title="Adjuntos">
                                    <label class="block basis-full text-sm font-bold text-mtv-text-gray mt-2 mb-2 self-center">
                                        Ficha técnica
                                    </label>
                                    <x-input-upload
                                        size="compact"
                                        name="ficha_tecnica_file"
                                        id="ficha_tecnica_file"
                                    />
                                    <label class="block basis-full text-sm font-bold text-mtv-text-gray mt-2 mb-2 self-center">
                                        Otro documento. Por ejemplo: certificados , manual de uso, entre otros.
                                    </label>
                                    <x-input-upload
                                        size="compact"
                                        name="otro_documento_file"
                                        id="otro_documento_file"
                                        :allow_delete="true"
                                    />
                                </x-field-group-card>
                                <label class="text-xs text-mtv-text-gray italic mt-2">Formato PDF de hasta 3MB.</label>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button"
                                    @click.preventDefault="enviarProductoForm()"
                                    class="mtv-button-secondary">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>

            <script type="text/javascript">
                function productoInfo() {
                    return {
                        productoId: {!! json_encode($producto->id) !!},
                        productoEditado: null,
                        productoModalForm: new bootstrap.Modal(document.getElementById('productoModal'), { keyboard: true }),
                        errores: null,
                        initProductoInfo() {
                            document.getElementById('productoModal').addEventListener('show.bs.modal', () => {
                                this.productoEditado = null;
                                this.productoEditado = this.productoId;
                            });
                            document.getElementById('productoModal').addEventListener('hidden.bs.modal', () => {
                                this.productoEditado = null;
                            });
                        },
                        editFormClose() {
                            this.productoModalForm.hide();
                        },
                        enviarProductoForm() {
                            const productoForm = document.getElementById('productoForm');
                            const formData = new FormData(productoForm);

                            fetch('{{ route("productos.update", [$producto->id]) }}', {
                                /*accept: 'application/json',*/
                                credentials: 'same-origin',
                                headers: {
                                    'X-CSRF-Token': '{{ csrf_token() }}',
                                },
                                method: 'POST',
                                body: formData
                            }).then(res => {
                                console.log(res);
                                if (res.ok) {
                                    this.productoModalForm.hide();
                                    location.reload();
                                } else {
                                    this.errores = res.errors;
                                }
                            });
                        },
                    }
                }
            </script>
        @endrole
    </div>
</div>

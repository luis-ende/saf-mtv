<x-app-layout :show_main_menu="false">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-4">
        <div class="bg-white overflow-hidden shadow-sm h-fit"
             x-data="busquedaCABMS"
             x-init="initBusquedaCABMS()">
            @include('catalogo-productos.registro-header',
                       ['titulo' => '',
                        'subtitulo' => '',
                        'texto_secuencia' => 'Paso 3 de 3'])

            <div class="mx-auto flex flex-col w-3/4" x-data="listaProductos()">
                <label class="block basis-full text-xl font-bold text-mtv-secondary mt-2 mb-4 self-center">
                    Información de producto
                </label>
                <label class="text-mtv-gray text-base mb-5 self-center">
                    Usando el icono “lápiz”, selecciona la categoría, nombre y agrega las fotografías de tu producto.
                </label>

                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead class="table-light">
                        <tr class="text-mtv-gray font-normal uppercase">
                            <th>#</th>
                            <th>Tipo</th>
                            <th>Nombre producto</th>
                            <th>Nombre catálogo CDMX</th>
                            <th>Categoría(s)</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                            <template x-for="(producto, index) in productos" :key="producto.id">
                                <tr>
                                    <td x-text="index + 1"></td>
                                    <td class="uppercase" x-text="producto.tipo === 'B' ? 'Bien' : 'Servicio'"></td>
                                    <td x-text="producto.nombre"></td>
                                    <td x-text="producto.nombre_cabms"></td>
                                    <td x-text="producto.categorias_scian"></td>
                                    <td>
                                        <div class="flex flex-row justify-end">
                                            <a href="#"
                                               data-bs-toggle="modal"
                                               data-bs-target="#productoModal"
                                               @click="event.preventDefault(); editaProducto(producto.id)" aria-label="Editar"
                                               class="text-mtv-text-gray text-base no-underline hover:text-mtv-secondary flex-basis-1/2 self-center">
                                                @svg('carbon-edit', ['class' => 'h-5 w-5 inline-block mr-3'])
                                            </a>
                                            <a href="#" @click="event.preventDefault(); eliminaProducto(producto.id)"
                                            aria-label="Eliminar"
                                            class="text-mtv-text-gray text-base no-underline hover:text-mtv-secondary flex-basis-1/2 self-center">
                                                @svg('heroicon-o-trash', ['class' => 'h-5 w-5 inline-block'])
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>

                <form method="POST" 
                      action="{{ route('carga-productos.store', [3]) }}" 
                      class="self-center"
                      @submit="validaProductos($event)">
                    @csrf
                    <button type="submit"
                            class="mtv-button-secondary my-4">
                        Finalizar
                    </button>
                </form>

                <!-- Modal -->
                <div class="modal fade" id="productoModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="productoModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-mtv-gray-light">
                                <h5 class="modal-title" id="productoModalLabel">Información de tu producto</h5>
                                <button type="button" class="btn-close" @click="editFormClose()" aria-label="Close"></button>
                            </div>
                            <div id="productoFormContainer" class="modal-body">
                                <x-cabms-categorias-select />
                                <x-producto-fotos-upload />
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="mtv-button-secondary" @click="guardaProducto(productoEditado)">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <script type="text/javascript">
                    function listaProductos() {
                        return {
                            productos: {!! json_encode($productos) !!},
                            productoEditado: null,
                            productoModalForm: new bootstrap.Modal(document.getElementById('productoModal'), { keyboard: true }),
                            guardaProducto(id) {
                                const formData = new FormData();
                                formData.append('id_cabms', document.getElementById('id_cabms').value);
                                const categoriasSCian = document.getElementById('categorias_scian').options;
                                for (let i = 0; i <= categoriasSCian.length - 1; i++) {
                                    formData.append('ids_categorias_scian[]', categoriasSCian[i].value);
                                }                                                                
                                formData.append('producto_fotos_eliminadas', document.getElementById('producto_fotos_eliminadas').value);
                                const productoFotos = document.getElementById('producto_fotos').files;
                                for (let i = 0; i <= productoFotos.length - 1; i++) {
                                    formData.append('producto_fotos[]', productoFotos[i], productoFotos[i].name);
                                }

                                fetch('/carga-productos/producto/' + id, {
                                    method: "POST",
                                    credentials: 'same-origin',
                                    headers: {
                                        'X-CSRF-Token': '{{ csrf_token() }}',
                                    },
                                    body: formData,
                                }).then(response => {
                                    if (!response.ok) {
                                        this.productoEditado = null;
                                        this.mensajeError = "Error"
                                        Swal.fire({
                                            ...SwalMTVCustom,
                                            title: this.mensajeError,
                                            html: "El producto no pudo ser guardado.",
                                            showCancelButton: false,
                                            confirmButtonText: 'Aceptar',
                                        })
                                    } else {
                                        return response.json();
                                    }
                                }).then(json => {
                                    const producto = this.productos.find(producto => producto.id == id);
                                    producto.id_cabms = json.id_cabms;
                                    producto.nombre_cabms = json.nombre_cabms;
                                    producto.categorias_scian = json.categorias_scian;
                                })

                                this.productoModalForm.hide();
                            },
                            editaProducto(id) {
                                this.productoEditado = id;
                                document.getElementById('producto_fotos').value = '';
                            },
                            editFormClose() {
                                this.productoEditado = null;
                                this.productoModalForm.hide()
                            },
                            eliminaProducto(id) {
                                Swal.fire({
                                    ...SwalMTVCustom,
                                    title: 'Eliminar producto',
                                    html: '<span>¿Deseas eliminar el producto del catálogo?</span>',
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        fetch('/productos/delete/' + id, {
                                            method: "DELETE",
                                            credentials: 'same-origin',
                                            headers: {
                                                'X-CSRF-Token': '{{ csrf_token() }}',
                                            },
                                        }).then(response => {
                                            console.log(response);
                                            if (response.ok) {
                                                this.productos = this.productos.filter(item => item.id !== id);
                                            }
                                        });
                                    }
                                })
                            },
                            // Valida que todos los productos importados hayan sido completados 
                            // con su correspondiente cabms y categorias.
                            validaProductos(e) {                                                                
                                let existeProductoIncompleto = 
                                    this.productos.some(producto => 
                                        !producto.nombre_cabms || producto.categorias_scian === '');
                            
                                if (existeProductoIncompleto) {
                                    Swal.fire({
                                        ...SwalMTVCustom,
                                        title: 'Datos incompletos',
                                        html: "No es posible finalizar la carga de productos. Asigna el nombre y categoría correspondientes para cada producto.",                                    
                                        showCancelButton: false,
                                        confirmButtonText: 'Aceptar',
                                    });                              
                                    
                                    e.preventDefault();
                                }                                                                
                            }
                        }
                    }
                </script>
            </div>
        </div>
    </div>
</x-app-layout>

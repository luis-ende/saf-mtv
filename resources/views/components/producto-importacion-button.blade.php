<div x-data="productoListaImportacion()" x-init="initData()">
    <button class="btn btn-primary mr-2"
            type="button"
            @click="clickImportacionButton()">
        @svg('polaris-major-import-store', ['class' => 'h-7 w-7 inline-block mr-1'])
        Importar lista
    </button>

    <!-- Modal -->
    <div class="modal fade" id="importOpcionesModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="importOpcionesModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="importOpcionesModalLabel">Opciones de importación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id="opcionesFormContainer" class="modal-body">
                    <div x-show="processing">
                        <div class="d-flex justify-content-center">
                            <div class="spinner-grow text-danger" role="status">
                                <span class="visually-hidden">Importando...</span>
                            </div>
                            <p class="ml-3 mt-1">Importando, espere un momento...</p>
                        </div>
                    </div>
                    <div x-show="!processing" id="importacion-opciones">
                        <div class="form-group col-md-12 mb-3">
                            <label class="mr-5">Importar</label>
                            <div class="form-check form-check-inline">
                                <label class="form-check-label" for="tipo_producto_bien">Bienes</label>
                                <input type="radio"
                                    class="form-check-input"
                                    id="tipo_producto_bien"
                                    name="map_tipo_producto"
                                    value="B"
                                    checked
                                >
                            </div>
                            <div class="form-check form-check-inline">
                                <label class="form-check-label" for="tipo_producto_servicio">Servicios</label>
                                <input type="radio"
                                    class="form-check-input"
                                    id="tipo_producto_servicio"
                                    name="map_tipo_producto"
                                    value="S"
                                >
                            </div>
                        </div>
                        <p class="mt-3">Relacione las columnas del archivo a importar.</p>
                        <table class="table table-striped table-sm ">
                            <thead class="table-light">
                            <tr>
                                <th scope="col">Clave CABMS</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Descripcion</th>
                                <th scope="col">Precio</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    <select id="map_clave_cabms" name="map_clave_cabms" class="form-control" required>
                                        <template x-for="column in previewExcelColumns" :key="column">
                                            <option :value="column" x-text="column"></option>
                                        </template>
                                    </select>
                                </td>
                                <td>
                                    <select id="map_nombre" name="map_nombre" class="form-control" required>
                                        <template x-for="column in previewExcelColumns" :key="column">
                                            <option :value="column" x-text="column"></option>
                                        </template>
                                    </select>
                                </td>
                                <td>
                                    <select id="map_descripcion" name="map_descripcion" class="form-control" required>
                                        <template x-for="column in previewExcelColumns" :key="column">
                                            <option :value="column" x-text="column"></option>
                                        </template>
                                    </select>
                                </td>
                                <td>
                                    <select id="map_precio" name="map_precio" class="form-control" required>
                                        <template x-for="column in previewExcelColumns" :key="column">
                                            <option :value="column" x-text="column"></option>
                                        </template>
                                    </select>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" :disabled="processing">Cancelar</button>
                    <button type="button" class="btn btn-primary" @click="importarProductos()" :disabled="processing">Continuar</button>
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
    <script src="https://unpkg.com/xlsx/dist/xlsx.full.min.js"></script>
    <script type="text/javascript">
        function productoListaImportacion() {
            return {
                importacionModalForm: null,
                previewExcelColumns: null,
                importacionArchivo: null,
                processing: false,

                async clickImportacionButton () {
                    const { value: file } = await Swal.fire({
                        title: 'Importación de productos',
                        html: 'Seleccione el archivo a importar.',
                        input: 'file',
                        showCancelButton: true,
                        confirmButtonColor: '#691C32',
                        confirmButtonText: 'Continuar',
                        cancelButtonText: `Cancelar`,
                        inputAttributes: {
                            'accept': 'application/xlsx',
                            'aria-label': 'Seleccione el archivo a importar'
                        }
                        })

                        this.importacionArchivo = null;
                        // Opciones antes de iniciar la importación
                        if (file) {
                            this.importacionModalForm.show();
                            const reader = new FileReader();
                            reader.onload = e => {
                                const data = e.target.result;
                                const workbook = XLSX.read(data, {
                                    type: 'binary'
                                });

                                workbook.SheetNames.forEach(sheetName => {
                                    const XL_row_object = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[sheetName]);
                                    if (XL_row_object.length >= 1) {
                                        this.previewExcelColumns = Object.keys(XL_row_object[0]);
                                    }
                                    console.log(this.previewExcelColumns);
                                })
                            }

                            reader.onerror = function(ex) {
                                Swal.fire(
                                    'Ocurrió un error al abrir el archivo.',
                                    'Verifique que el formato del archivo sea correcto (Excel, CSV).',
                                    'error'
                                )
                            };


                            this.importacionArchivo = file;
                            reader.readAsBinaryString(file)
                        }
                },
                importarProductos () {
                    const formData = new FormData();

                    formData.append('productos_archivo', this.importacionArchivo, this.importacionArchivo.name);
                    formData.append('map_clave_cabms', document.getElementById('map_clave_cabms').value);
                    formData.append('map_nombre', document.getElementById('map_nombre').value);
                    formData.append('map_descripcion', document.getElementById('map_descripcion').value);
                    formData.append('map_precio', document.getElementById('map_precio').value);
                    formData.append('map_tipo_producto', document.getElementsByName('map_tipo_producto')[0].value);

                    this.processing = true;
                    fetch('{{ route('productos.import') }}', {
                            method: "POST",
                            credentials: 'same-origin',
                            headers: {
                                "X-CSRF-Token": '{{ csrf_token() }}',
                            },
                            body: formData,
                        }).then(response => {
                            this.processing = false;
                            if (response.ok) {
                                sessionStorage.setItem('productosImportados', 'true');
                                this.importacionModalForm.hide();
                                document.location.reload();
                            } else {
                                response.json().then(json => {
                                    Swal.fire({
                                        confirmButtonColor: '#691C32',
                                        confirmButtonText: 'Aceptar',
                                        icon: "error",
                                        title: 'Error de importación',
                                        html: 'Ocurrió un error al realizar la importación: ' + json.error,
                                    })
                                })
                            }
                        });
                },
                initData () {
                    const importOpcionesModal = document.getElementById('importOpcionesModal');
                    this.importacionModalForm = new bootstrap.Modal(importOpcionesModal, { keyboard: true });

                    if (sessionStorage.getItem('productosImportados')) {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: false,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        });

                        Toast.fire({
                            icon: 'success',
                            title: 'Productos importados exitósamente.'
                        });
                        sessionStorage.removeItem('productosImportados');
                    }
                }
            }
        }
    </script>
@endsection

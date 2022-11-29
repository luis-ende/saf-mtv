<div x-data="productoListaImportacion()">
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
                    <p>Relacione las columnas correspondientes.</p>
                    <table class="table table-striped table-sm ">
                        <thead class="table-light">
                        <tr>
                            <th scope="col">Clave CABMS</th>
                            <th scope="col">Tipo</th>
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
                                <select id="map_clave_cabms" name="map_clave_cabms" class="form-control" required>
                                    <template x-for="column in previewExcelColumns" :key="column">
                                        <option :value="column" x-text="column"></option>
                                    </template>
                                </select>
                            </td>
                            <td>
                                <select id="map_clave_cabms" name="map_clave_cabms" class="form-control" required>
                                    <template x-for="column in previewExcelColumns" :key="column">
                                        <option :value="column" x-text="column"></option>
                                    </template>
                                </select>
                            </td>
                            <td>
                                <select id="map_clave_cabms" name="map_clave_cabms" class="form-control" required>
                                    <template x-for="column in previewExcelColumns" :key="column">
                                        <option :value="column" x-text="column"></option>
                                    </template>
                                </select>
                            </td>
                            <td>
                                <select id="map_clave_cabms" name="map_clave_cabms" class="form-control" required>
                                    <template x-for="column in previewExcelColumns" :key="column">
                                        <option :value="column" x-text="column"></option>
                                    </template>
                                </select>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" @click="guardaContacto()">Continuar</button>
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
                importacionModalForm: new bootstrap.Modal(document.getElementById('importOpcionesModal'), { keyboard: true }),
                previewExcelColumns: null,

                async clickImportacionButton() {
                    const { value: file } = await Swal.fire({
                        title: 'Seleccione el archivo a importar',
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
                            reader.readAsBinaryString(file)
                        }
                }
            }
        }
    </script>
@endsection

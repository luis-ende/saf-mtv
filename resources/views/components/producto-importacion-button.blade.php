<button x-data="productoListaImportacion()" class="btn btn-primary mr-2"
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
                                <select class="form-control">
                                    <option>Source 1</option>
                                    <option>Source 2</option>
                                    <option>Source 3</option>
                                </select>
                            </td>                            
                            <td>
                                <select class="form-control">
                                    <option>Source 1</option>
                                    <option>Source 2</option>
                                    <option>Source 3</option>
                                </select>
                            </td>        
                            <td>
                                <select class="form-control">
                                    <option>Source 1</option>
                                    <option>Source 2</option>
                                    <option>Source 3</option>
                                </select>
                            </td>        
                            <td>
                                <select class="form-control"> 
                                    <option>Source 1</option>
                                    <option>Source 2</option>
                                    <option>Source 3</option>
                                </select>
                            </td>        
                            <td>
                                <select class="form-control">
                                    <option>Source 1</option>
                                    <option>Source 2</option>
                                    <option>Source 3</option>
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

<script type="text/javascript">
    function productoListaImportacion() {
        return {
            importacionModalForm: new bootstrap.Modal(document.getElementById('importOpcionesModal'), { keyboard: true }),

            async clickImportacionButton() {
                const { value: file } = await Swal.fire({
                    title: 'Seleccione el archivo a importar',
                    input: 'file',
                    showCancelButton: true,
                    confirmButtonColor: '#691C32',
                    confirmButtonText: 'Continuar',
                    cancelButtonText: `Cancelar`,
                    inputAttributes: {
                        'accept': 'text/csv',
                        'aria-label': 'Seleccione el archivo a importar'
                    }
                    })

                    // Opciones antes de iniciar la importación
                    if (file) {
                        this.importacionModalForm.show();
                        /* const reader = new FileReader()
                        reader.onload = (e) => {
                            Swal.fire({
                            title: 'Your uploaded picture',
                            imageUrl: e.target.result,
                            imageAlt: 'The uploaded picture'
                            })
                        }
                        reader.readAsDataURL(file) */
                    }                
            }
        }
    }    
</script>
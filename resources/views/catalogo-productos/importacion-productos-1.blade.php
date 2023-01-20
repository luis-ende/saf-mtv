<x-app-layout :show_main_menu="false">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-4">
        <div class="bg-white overflow-hidden shadow-sm h-screen">
            @include('catalogo-productos.registro-header',
                       ['titulo' => 'Carga masiva de productos',
                        'titulo_icono' => 'tabler-table-import',
                        'subtitulo' => '',
                        'texto_secuencia' => 'Paso 1 de 3'])
            <form id="cargaProductosForm"
                  method="POST"
                  enctype="multipart/form-data"
                  action="{{ route('carga-productos.store', [1]) }}" class="px-6">
                @csrf                
                <div class="mx-auto flex flex-col w-1/2" x-data="importacionProductos1()">
                    <a href="{{ Storage::url('plantillas/productos_carga_masiva.xlsx') }}"
                       download="MTV_Plantilla_Productos.xlsx"
                       class="mtv-button-secondary-white text-lg no-underline self-center my-4 flex flex-row items-center">
                        @svg('vaadin-file-table', ['class' => 'w-4 h-4 inline-block mr-1'])
                        <span>Descarga la plantilla</span>
                    </a>
                    <label class="block basis-full text-xl font-bold text-mtv-secondary mt-2 mb-2 self-center">
                        1. Selecciona el archivo
                    </label>
                    <label class="text-mtv-gray text-base mb-3 self-center">
                       Adjunta la plantilla en extensión .xlsx.
                    </label>
                    <x-input-upload
                        :name="__('productos_import_file')"
                        :id="__('productos_import_file')"
                    />
                    <div class="flex flex-row my-4 space-x-10 justify-center">
                        <a href="{{ route('catalogo-registro-inicio') }}" class="mtv-button-secondary-white no-underline self-center">
                            @svg('fas-arrow-left', ['class' => 'h-7 w-7 inline-block'])
                            Atrás
                        </a>
                        <button type="submit"
                                @click="muestraConfirmacion($event)"
                                class="mtv-button-secondary self-center my-4">
                            Procesar
                        </button>
                    </div>    
                </div>
            </form>

            <script type="text/javascript">
                function importacionProductos1() {
                    return {
                        muestraConfirmacion(e) {
                            e.preventDefault();
                            Swal.fire({
                                ...SwalMTVCustom,
                                title: 'Confirmación',
                                html: "Sólo se te permite una carga masiva de datos." +
                                    '<p class="font-bold mt-3">¿Quieres importar tus productos en este momento?</p>',
                                confirmButtonText: 'Sí',
                                cancelButtonText: 'Después',
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    document.getElementById('cargaProductosForm').submit();
                                }
                            })
                        }
                    }
                }
            </script>
        </div>
    </div>
</x-app-layout>

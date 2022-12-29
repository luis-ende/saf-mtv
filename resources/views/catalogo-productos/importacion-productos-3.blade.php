<x-app-layout :show_main_menu="false">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-4">
        <div class="bg-white overflow-hidden shadow-sm h-screen">
            @include('catalogo-productos.registro-header',
                       ['titulo' => '',                        
                        'subtitulo' => '',
                        'texto_secuencia' => 'Paso 3 de 3'])
            <form id="cargaProductosForm" method="POST" action="{{ route('carga-productos.store', [1]) }}" class="px-6">
                @csrf
                <div class="mx-auto flex flex-col w-1/2" x-data="importacionProductos1()">                    
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
                                <th scope="col">#</th>
                                <th scope="col">Tipo</th>
                                <th scope="col">Nombre producto</th>                                
                                <th scope="col">Nombre catálogo CDMX</th>                                
                                <th scope="col">Categoría</th>                                
                                <th scope="col"></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>                            
                                <tr>
                                    <td>1</td>
                                    <td>BIEN</td>
                                    <td>XXXX XXXX XXXXX XXXXXXXX</td>
                                    <td>X</td>
                                    <td>X</td>
                                    <td>
                                        <a href="#"
                                           data-bs-toggle="modal"
                                           data-bs-target="#contactosModal"
                                           @click="event.preventDefault(); editaContacto(contacto.id)" aria-label="Editar"
                                           class="text-mtv-text-gray text-base no-underline hover:text-mtv-secondary">
                                            @svg('carbon-edit', ['class' => 'h-5 w-5 inline-block mr-3'])
                                        </a>
                                        <a href="#" @click="event.preventDefault(); eliminaContacto(contacto.id)"
                                           aria-label="Eliminar"
                                           class="text-mtv-text-gray text-base no-underline hover:text-mtv-secondary">
                                            @svg('heroicon-o-trash', ['class' => 'h-5 w-5 inline-block'])
                                        </a>
                                    </td>
                                <tr>                            
                                <tr>
                                    <td>2</td>
                                    <td>BIEN</td>
                                    <td>XXXX XXXX XXXXX XXXXXXXX</td>
                                    <td>X</td>
                                    <td>X</td>
                                    <td>
                                        <a href="#"
                                           data-bs-toggle="modal"
                                           data-bs-target="#contactosModal"
                                           @click="event.preventDefault(); editaContacto(contacto.id)" aria-label="Editar"
                                           class="text-mtv-text-gray text-base no-underline hover:text-mtv-secondary">
                                            @svg('carbon-edit', ['class' => 'h-5 w-5 inline-block mr-3'])
                                        </a>
                                        <a href="#" @click="event.preventDefault(); eliminaContacto(contacto.id)"
                                           aria-label="Eliminar"
                                           class="text-mtv-text-gray text-base no-underline hover:text-mtv-secondary">
                                            @svg('heroicon-o-trash', ['class' => 'h-5 w-5 inline-block'])
                                        </a>
                                    </td>
                                <tr>
                                <tr>
                                    <td>3</td>
                                    <td>SERVICIO</td>
                                    <td>XXXX XXXX XXXXX XXXXXXXX</td>
                                    <td>X</td>
                                    <td>X</td>
                                    <td>
                                        <a href="#"
                                           data-bs-toggle="modal"
                                           data-bs-target="#contactosModal"
                                           @click="event.preventDefault(); editaContacto(contacto.id)" aria-label="Editar"
                                           class="text-mtv-text-gray text-base no-underline hover:text-mtv-secondary">
                                            @svg('carbon-edit', ['class' => 'h-5 w-5 inline-block mr-3'])
                                        </a>
                                        <a href="#" @click="event.preventDefault(); eliminaContacto(contacto.id)"
                                           aria-label="Eliminar"
                                           class="text-mtv-text-gray text-base no-underline hover:text-mtv-secondary">
                                            @svg('heroicon-o-trash', ['class' => 'h-5 w-5 inline-block'])
                                        </a>
                                    </td>
                                <tr>                                                        
                            </tbody>
                        </table>
                    </div>

                    <button type="button"                            
                            class="mtv-button-secondary self-center my-4">
                        Finalizar
                    </button>                    
                </div>                
            </form>            
        </div>
    </div>  
    
    <!-- Modal -->
    <div class="modal fade" id="productoModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="productoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-mtv-gray-light">
                    <h5 class="modal-title" id="productoModalLabel">Contactos</h5>
                    <button type="button" class="btn-close" @click="contactosModalForm.hide()" aria-label="Close"></button>
                </div>
                <div id="productoFormContainer" class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="mtv-button-secondary" @click="guardaContacto()">Guardar</button>
                </div>
            </div>
        </div>
    </div>    
</x-app-layout>
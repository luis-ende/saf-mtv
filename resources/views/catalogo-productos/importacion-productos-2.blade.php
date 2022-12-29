<x-app-layout :show_main_menu="false">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-4">
        <div class="bg-white overflow-hidden shadow-sm h-screen">
            @include('catalogo-productos.registro-header',
                       ['titulo' => '',                        
                        'subtitulo' => '',
                        'texto_secuencia' => 'Paso 2 de 3'])
            <form id="cargaProductosForm" method="POST" action="{{ route('carga-productos.store', [1]) }}" class="px-6">
                @csrf
                <div class="mx-auto flex flex-col w-1/2" x-data="importacionProductos1()">                    
                    <label class="block basis-full text-xl font-bold text-mtv-secondary mt-2 mb-4 self-center">
                        Procesamiento de datos
                    </label>
                    <ul class="self-center">
                        <li class="mb-3">
                            @svg('lucide-check-circle', ['class' => 'w-5 h-5 inline-block text-mtv-secondary mr-3'])
                            Total de productos:
                        </li>
                        <li class="mb-3">
                            @svg('lucide-check-circle', ['class' => 'w-5 h-5 inline-block text-mtv-secondary mr-3'])
                            Total de productos cargados:
                        </li>
                        <li class="mb-3">
                            @svg('lucide-check-circle', ['class' => 'w-5 h-5 inline-block text-mtv-secondary mr-3'])
                            Productos rechazados:
                        </li>
                    </ul>    
                    
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead class="table-light">
                            <tr class="text-mtv-gray font-normal uppercase">
                                <th scope="col">#</th>
                                <th scope="col">Tipo</th>
                                <th scope="col">Nombre producto</th>                                
                                <th scope="col">Error</th>                                
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>                            
                                <tr>
                                    <td>1</td>
                                    <td>BIEN</td>
                                    <td>XXXX XXXX XXXXX XXXXXXXX</td>
                                    <td>Errores</td>
                                <tr>                            
                                <tr>
                                    <td>2</td>
                                    <td>BIEN</td>
                                    <td>XXXX XXXX XXXXX XXXXXXXX</td>
                                    <td>Errores</td>
                                <tr>
                                <tr>
                                    <td>3</td>
                                    <td>SERVICIO</td>
                                    <td>XXXX XXXX XXXXX XXXXXXXX</td>
                                    <td>Errores</td>
                                <tr>                                                        
                            </tbody>
                        </table>
                    </div>

                    <button type="submit"                            
                            class="mtv-button-secondary self-center my-4">
                        Guardar y continuar
                    </button>                    
                </div>                
            </form>            
        </div>
    </div>    
</x-app-layout>
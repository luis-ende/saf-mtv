<x-app-layout :show_main_menu="false">
    @section('page_title', 'Carga masiva de productos 2')
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-4">
        <div class="bg-white overflow-hidden shadow-sm min-h-screen">
            @include('catalogo-productos.registro-header',
                       ['titulo' => '',                        
                        'subtitulo' => '',
                        'texto_secuencia' => 'Paso 2 de 3'])
            <form id="cargaProductosForm" method="POST" 
                  action="{{ route('carga-productos.store', [2]) }}" class="px-6">
                @csrf                
                <div class="mx-auto flex flex-col w-1/2"">                    
                    <label class="block basis-full text-xl font-bold text-mtv-secondary mt-2 mb-4 self-center">
                        Procesamiento de datos
                    </label>
                    <ul class="self-center">
                        <li class="mb-3">
                            @svg('lucide-check-circle', ['class' => 'w-5 h-5 inline-block text-mtv-secondary mr-3'])
                            Total de productos: {{ count($rows) }}
                        </li>
                        <li class="mb-3">
                            @svg('lucide-check-circle', ['class' => 'w-5 h-5 inline-block text-mtv-secondary mr-3'])
                            Total de productos cargados: {{ count($rows) }}
                        </li>
                        <li class="mb-3">                            
                            @if($productos_rechazados > 0) 
                                @svg('feathericon-alert-circle', ['class' => 'w-5 h-5 inline-block text-mtv-primary mr-3'])
                            @else 
                                @svg('lucide-check-circle', ['class' => 'w-5 h-5 inline-block text-mtv-secondary mr-3'])                           
                            @endif                            
                            Productos rechazados: {{ $productos_rechazados }}
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
                                @foreach($rows as $row)                           
                                    <tr class="{{ $row['errores'] ? 'bg-red-100' : '' }}">
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td class="uppercase">{{ $row['tipo'] }}</td>
                                        <td>{{ $row['nombre_producto'] }}</td>
                                        <td>   
                                            @if($row['errores'])                                         
                                                <ul class="text-mtv-primary list-outside list-disc m-0">
                                                    @foreach($row['errores'] as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach                                                    
                                                </ul>
                                            @endif                                            
                                        </td>
                                    <tr>
                                @endforeach                                                                                     
                            </tbody>
                        </table>
                    </div>

                    @if($productos_rechazados > 0)
                        <a href="{{ route('importacion-productos-1.show') }}"
                           class="mtv-button-secondary self-center my-4 no-underline">
                            Cargar nuevo archivo
                        </a>                    
                    @else                    
                        <button type="submit"
                                class="mtv-button-secondary self-center my-4">
                            Cargar productos
                        </button>
                    @endif                    
                </div>                
            </form>            
        </div>
    </div>    
</x-app-layout>
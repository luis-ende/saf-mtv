<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden h-fit">
            <div class="py-6 px-12 bg-white border-b border-gray-200 flex flex-col">
                <div class="self-center">
                    <label class="text-mtv-gray-2 text-xl">
                        Catálogo de productos
                    </label>
                    <div class="text-mtv-primary font-bold text-3xl">
                        Buscador de productos y proveedores de Mi Tiendita Virtual
                    </div>      
                </div>
                <div class="self-center">
                    <div class="flex flex-row space-x-4 mt-2">
                        <span class="w-1 h-1 inline-block bg-mtv-gold-light"></span>
                        <span class="w-1 h-1 inline-block bg-mtv-gold-light"></span>
                        <span class="w-1 h-1 inline-block bg-mtv-gold-light"></span>
                        <span class="w-1 h-1 inline-block bg-mtv-gold-light"></span>
                        <span class="w-1 h-1 inline-block bg-mtv-gold-light"></span>
                        <span class="w-1 h-1 inline-block bg-mtv-gold-light"></span>
                    </div>
                </div>    
            </div>                  
            <div class="py-6 px-12">
                <div x-data="{ tab: 'productos' }">
                    <nav class="font-bold text-lg text-mtv-gold flex flex-row mb-3">
                        <a class="no-underline border-b-4 basis-1/2 text-center" 
                           :class="tab === 'productos' ? 'text-mtv-secondary border-mtv-secondary hover:text-mtv-secondary' : 'text-mtv-gold border-mtv-gold-light hover:text-mtv-gold'"
                           x-on:click.prevent="tab = 'productos'" 
                           href="#">
                            Más de {{ $num_productos_registrados }} productos registrados
                        </a>
                        <a class="no-underline border-b-4 basis-1/2 text-center" 
                           :class="tab === 'proveedores' ? 'text-mtv-secondary border-mtv-secondary hover:text-mtv-secondary' : 'text-mtv-gold border-mtv-gold-light hover:text-mtv-gold'"
                            x-on:click.prevent="tab = 'proveedores'" 
                            href="#">
                            Más de {{ $num_proveedores_registrados }} proveedores registrados
                        </a>
                    </nav>
                    <div class="flex flex-col" x-show="tab === 'productos'">
                        <div class="w-3/4 self-center">
                            <form method="POST" action="{{ route('busqueda-productos.search') }}">
                                @csrf

                                <label for="productos_search" class="text-mtv-gray-2 text-base mb-2">
                                    Tu búsqueda es por productos:
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                    </div>
                                    <input type="search"
                                           id="productos_search" name="productos_search"
                                           class="block w-full pt-3 pb-3 pl-10 text-sm text-mtv-text-gray border border-gray-300 rounded-lg bg-gray-50 focus:ring-mtv-primary focus:border-mtv-primary"
                                           placeholder="Buscar por palabras clave..."
                                           autofocus
                                           value="{{ $term_busqueda ?? '' }}">
                                    <button type="submit" class="mtv-button-secondary absolute right-2.5 bottom-[0.525rem] m-0 mt-1">Buscar</button>
                                </div>
                            </form>                            
                            @isset($num_resultados)
                                @if($num_resultados === 0 && !empty($term_busqueda))
                                    <div class="p-0 mt-2 text-slate-700">
                                        No se encontraron productos con el término <span class="font-bold">"{{ $term_busqueda }}"</span>.
                                    </div>
                                @endif
                                @if($num_resultados > 0 && !empty($term_busqueda))
                                    <div class="p-0 mt-2 mb-5 text-slate-700">
                                        <span class="font-bold">{{ $num_resultados }}</span> Productos encontrados con el término <span class="font-bold">"{{ $term_busqueda }}</span>
                                    </div>
                                @endif
                            @endisset                                                        
                        </div>

                        @isset($productos)
                        <div class="w-full">
                            <x-productos-grid 
                                :productos="$productos" />
                        </div>
                        @endisset
                    </div>
                    <div x-show="tab === 'proveedores'">
                        
                    </div>                    
                </div>
            </div>
        </div>
    </div>    
</x-app-layout>

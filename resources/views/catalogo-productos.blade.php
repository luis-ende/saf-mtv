<x-app-layout>    
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden h-fit">
            <div class="text-2xl py-6 px-12 bg-white border-b border-gray-200 flex flex-row items-center">
                <div class="uppercase text-mtv-primary font-bold p-2 basis-1/2">
                    Catálogo
                </div>
                <div class="basis-1/2 text-end">
                    <a href="{{ route('alta-producto-1.show') }}"
                        class="mtv-button-secondary text-base no-underline">
                        @svg('polaris-major-add-product', ['class' => 'w-5 h-5 inline-block mr-3'])
                        Agregar producto
                    </a>
                </div>
            </div>            
            <div class="py-6 px-12">
                <div x-data="{ tab: 'bienes' }">
                    <nav class="font-bold text-lg text-mtv-gold flex flex-row mb-5">                        
                        <a class="no-underline border-b-4 basis-1/2 text-center" 
                           :class="tab === 'bienes' ? 'text-mtv-secondary border-mtv-secondary hover:text-mtv-secondary' : 'text-mtv-gold border-mtv-gold-light hover:text-mtv-gold'"
                           x-on:click.prevent="tab = 'bienes'" 
                           href="#">
                           {{ count($productos_bien) }} Productos
                        </a>
                        <a class="hover:text-mtv-gold no-underline border-b-4 border-mtv-gold-light basis-1/2 text-center" 
                        :class="tab === 'servicios' ? 'text-mtv-secondary border-mtv-secondary hover:text-mtv-secondary' : 'text-mtv-gold border-mtv-gold-light hover:text-mtv-gold'"
                           x-on:click.prevent="tab = 'servicios'" 
                           href="#">
                           {{ count($productos_servicio) }} Servicios
                        </a>
                    </nav>
                    <div x-show="tab === 'bienes'">
                        <x-productos-grid 
                            :productos="$productos_bien"
                        />
                    </div>
                    <div x-show="tab === 'servicios'">
                        <x-productos-grid 
                            :productos="$productos_servicio"
                        />
                    </div>                    
                </div>
            </div>
        </div>
    </div>    
</x-app-layout>

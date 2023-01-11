<x-app-layout>    
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden h-fit">
            <div class="text-2xl py-6 px-12 bg-white border-b border-gray-200 flex flex-row">
                <div class="uppercase text-mtv-primary font-bold p-2 basis-1/2">
                    Producto
                </div>        
                <div class="basis-1/2 text-end">
                    @role('proveedor')
                        <a class="mtv-button-secondary text-base no-underline"
                        data-bs-toggle="modal"
                        data-bs-target="#productoModal">
                            @svg('carbon-edit', ['class' => 'w-5 h-5 inline-block mr-3'])
                            Editar
                        </a>
                    @endrole        
                </div>        
            </div>            
            <div class="py-6 px-12">                
                <x-producto-info-page 
                    :producto="$producto" />
            </div>
        </div>
    </div>    
</x-app-layout>

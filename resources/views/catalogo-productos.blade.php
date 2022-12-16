<x-app-layout>    
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden">
            <div class="text-slate-800 font-bold text-2xl p-6 bg-white border-b border-gray-200">
                @svg('gmdi-storefront-o', ['class' => 'h-7 w-7 inline-block mr-1'])
                Tu Tiendita Virtual
            </div>
            <div class="p-6 bg-[#F7F3ED] border-b border-gray-200 text-base">
                Completa y actualiza tu catálogo de los bienes o servicios que te gustaría ofrecer a la Ciudad de México. Al agregar productos en tu catálogo recibirás notificaciones cada que haya algún procedimiento de compra de acuerdo a la categoría del bien o servicio que hayas registrado.
            </div>
            <div class="p-6">
                <x-producto-form :mode="__('add')" />
                <div class="text-xl text-slate-900 font-bold mb-3">
                    @svg('polaris-major-products', ['class' => 'h-5 w-5 inline-block mr-1'])
                    Tus productos y servicios
                </div>
                <x-productos-table :productos="$productosPersona" />
            </div>
        </div>
    </div>    
</x-app-layout>

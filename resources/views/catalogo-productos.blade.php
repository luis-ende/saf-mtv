<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="text-[#BC955C] text-2xl p-6 bg-white border-b border-gray-200">
                    @svg('gmdi-storefront-o', ['class' => 'h-7 w-7 inline-block mr-1'])
                    Tu tiendita virtual
                </div>
                <div class="p-6 bg-white border-b border-gray-200 text-base">
                    Completa y actualiza tu catálogo de los bienes o servicios que te gustaría ofrecer a la Ciudad de México.
                </div>
                <div class="p-6">
                    <x-producto-form :mode="__('add')" /> <br>
                    <x-productos-table :productos="$productosPersona" />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

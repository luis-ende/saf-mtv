<<<<<<< HEAD
<x-app-layout>    
    <div class="py-12">
=======
<x-app-layout>
    <div class="py-6">
>>>>>>> 1ae41f2 (Se agregaron estilos y layouts para notificaciones de alerta)
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="text-[#BC955C] text-2xl p-6 bg-white border-b border-gray-200">
                    Detalles del producto
                </div>
                <div class="row">
                    <div class="accordion" id="producto-accordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading-datos-contacto">
                                <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#body-datos-contacto" aria-expanded="true" aria-controls="collapseOne">                                    
                                    @svg('gmdi-storefront-o', ['class' => 'h-5 w-5 inline-block mr-2'])
                                    Datos del producto
                                </button>
                            </h2>
                            <div id="body-datos-contacto" class="accordion-collapse collapse show" aria-labelledby="heading-datos-contacto" data-bs-parent="#producto-accordion">
                                <div class="accordion-body">
                                <x-producto-form :mode="__('edit')" :producto="$producto"/>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading-producto-negocio">
                                <button class="accordion-button fw-bold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#body-producto-negocio" aria-expanded="false" aria-controls="collapseTwo">
                                    @svg('bytesize-photo', ['class' => 'h-5 w-5 inline-block mr-3'])                                    
                                    Imágenes
                                </button>
                            </h2>
                            <div id="body-producto-negocio" class="accordion-collapse collapse" aria-labelledby="heading-producto-negocio" data-bs-parent="#producto-accordion">
                                <div class="accordion-body">
                                    <x-producto-photo-gallery/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

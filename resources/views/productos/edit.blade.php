<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden min-h-screen">
            <div class="text-slate-800 font-bold text-2xl p-6 bg-white border-b border-gray-200">
                @svg('heroicon-m-pencil-square', ['class' => 'h-7 w-7 inline-block mr-1'])
                Detalles del producto
            </div>
            <div class="px-4 py-4">
                <div class="accordion" id="producto-accordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading-datos-contacto">
                            <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#body-datos-contacto" aria-expanded="true" aria-controls="collapseOne">
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
                                Imágenes y archivos
                            </button>
                        </h2>
                        <div id="body-producto-negocio" class="accordion-collapse collapse" aria-labelledby="heading-producto-negocio" data-bs-parent="#producto-accordion">
                            <div class="accordion-body">
                                <x-producto-files-upload
                                    :producto_id="$producto->id"
                                />
                                <div class="text-slate-900 font-bold text-xl mt-3 mb-2">
                                    @svg('grommet-gallery', ['class' => 'h-5 w-5 inline-block mr-1'])
                                    Galería de archivos
                                </div>
                                <x-producto-media-gallery
                                    :producto_id="$producto->id"
                                    :media_items="$producto->getAllMedia()"
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

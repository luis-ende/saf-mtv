<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <ul class="nav nav-tabs mb-3" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a
                        class="nav-link active"
                        id="tab-detalles"
                        data-bs-toggle="tab"
                        href="#tab-content-detalles"
                        role="tab"
                        aria-controls="tab-content-detalles"
                        aria-selected="true">Detalles del producto</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a
                        class="nav-link"
                        id="tab-fotos"
                        data-bs-toggle="tab"
                        href="#tab-content-fotos"
                        role="tab"
                        aria-controls="tab-content-fotos"
                        aria-selected="false">Fotos</a>
                    </li>
                </ul>

                <div class="tab-content" id="producto_tabs_content">
                    <div class="tab-pane fade show active" id="tab-content-detalles" role="tabpanel" aria-labelledby="tab-detalles">
                        <x-producto-form :mode="__('edit')" :producto="$producto"/>
                    </div>
                    <div class="tab-pane fade" id="tab-content-fotos" role="tabpanel" aria-labelledby="tab-fotos">
                        <p>Fotos del producto</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden min-h-screen">
            <div class="text-2xl p-6 bg-white border-b border-gray-200">
                <div class="uppercase text-mtv-primary font-bold border-l-4 border-mtv-primary p-2">
                    Mi perfil
                </div>
            </div>
            <div class="px-4 py-4">
                <div class="accordion" id="perfil-accordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading-datos-contacto">
                            <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#body-datos-contacto" aria-expanded="true" aria-controls="body-datos-contacto">
                                Tu negocio
                            </button>
                        </h2>
                        <div id="body-datos-contacto" class="accordion-collapse collapse show" aria-labelledby="heading-datos-contacto" data-bs-parent="#perfil-accordion">
                            <div class="accordion-body bg-white">
                                <x-perfil-negocio-form
                                    :persona="$persona"
                                    :cat_paises="$cat_paises"
                                    :tipos_vialidad="$tipos_vialidad"
                                    :grupos_prioritarios="$grupos_prioritarios"
                                    :tipos_pyme="$tipos_pyme"
                                    :sectores="$sectores"
                                    :mode="__('edit')"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading-perfil-negocio">
                            <button class="accordion-button fw-bold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#body-perfil-negocio" aria-expanded="false" aria-controls="collapseTwo">
                                Contactos
                            </button>
                        </h2>
                        <div id="body-perfil-negocio" class="accordion-collapse collapse" aria-labelledby="heading-perfil-negocio" data-bs-parent="#perfil-accordion">
                            <div class="accordion-body bg-white">
                                <form action="{{ route('registro-contactos.store') }}" method="POST">
                                    @csrf
                                    <x-contactos-lista
                                        :persona="$persona"
                                    />
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

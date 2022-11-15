<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="text-[#BC955C] text-2xl p-6 bg-white border-b border-gray-200">
                    Mi Tiendita Virtual - Perfil de tu Negocio
                </div>
                <div class="row">
                    <div class="accordion" id="perfil-accordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading-datos-contacto">
                                <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#body-datos-contacto" aria-expanded="true" aria-controls="collapseOne">
                                    @svg('icomoon-profile', ['class' => 'h-5 w-5 inline-block mr-3'])
                                    Datos de contacto
                                </button>
                            </h2>
                            <div id="body-datos-contacto" class="accordion-collapse collapse show" aria-labelledby="heading-datos-contacto" data-bs-parent="#perfil-accordion">
                                <div class="accordion-body">
                                    <x-perfil-negocio-form
                                        :persona="$persona"
                                        :tipos_vialidad="$tipos_vialidad"
                                        :mode="__('edit')"
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading-perfil-negocio">
                                <button class="accordion-button fw-bold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#body-perfil-negocio" aria-expanded="false" aria-controls="collapseTwo">
                                    @svg('bytesize-portfolio', ['class' => 'h-5 w-5 inline-block mr-3'])
                                    Perfil de tu negocio
                                </button>
                            </h2>
                            <div id="body-perfil-negocio" class="accordion-collapse collapse" aria-labelledby="heading-perfil-negocio" data-bs-parent="#perfil-accordion">
                                <div class="accordion-body">
                                    <x-descripcion-negocio-form
                                        :perfil-negocio="$persona->perfil_negocio"
                                        :grupos_prioritarios="$grupos_prioritarios"
                                        :tipos_pyme="$tipos_pyme"
                                        :sectores="$sectores"
                                        :mode="__('edit')"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden min-h-screen">
            <div class="border-b border-gray-200">
                <x-page-header-label title="Perfil">
                    <div class="text-mtv-text-gray md:text-base sm:text-sm xs:text-xs uppercase">
                        {{ $persona->perfil_negocio->nombre_negocio }}
                    </div>
                </x-page-header-label>
            </div>

            @php($logotipoUrl = $persona->perfil_negocio->getFirstMediaUrl('logotipos'))
            <div class="px-4 py-4">
                <div class="accordion" id="perfil-accordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading-datos-contacto">
                            <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#body-datos-contacto" aria-expanded="true" aria-controls="body-datos-contacto">
                                Negocio
                            </button>
                        </h2>
                        <div id="body-datos-contacto" class="accordion-collapse collapse show" aria-labelledby="heading-datos-contacto" data-bs-parent="#perfil-accordion">
                            <div class="accordion-body flex flex-col space-y-5">
                                <x-field-group-card
                                    title="Datos de identificación" >
                                    <div class="flex flex-col uppercase text-mtv-gray-2">
                                        <span class="basis-full">
                                            <label>RFC:</label>
                                            <span class="text-mtv-gray ">{{ $persona->rfc }}</span>
                                        </span>
                                        <span class="basis-full flex flex-row">
                                            <span class="basis-1/3">
                                                <label>Nombre:</label>
                                                <span class="text-mtv-text-gray ">{{ $persona->nombre_o_razon_social() }}</span>
                                            </span>
                                            <span class="basis-1/3">
                                                <label>Persona:</label>
                                                <span class="text-mtv-text-gray ">{{ $persona->id_tipo_persona === 'F' ? 'Física' : 'Moral' }}</span>
                                            </span>
                                            <span class="basis-1/3">
                                                <label>Constancia:</label>
                                                <span class="text-mtv-text-gray">Sin registro</span>
                                            </span>
                                        </span>
                                    </div>
                                </x-field-group-card>

                                <x-field-group-card
                                    title="Domicilio" >
                                    <div class="flex flex-row text-mtv-gray-2">
                                        <span class="basis-1/3 flex flex-col">
                                            <label>País</label>
                                            <span class="text-mtv-text-gray uppercase">México</span>
                                        </span>
                                        <span class="basis-1/3 flex flex-col">
                                            <label>Entidad federativa</label>
                                            <span class="text-mtv-text-gray uppercase">{{ $persona->direccion()->entidad }}</span>
                                        </span>
                                        <span class="basis-1/3 flex flex-col">
                                            <label>Municipio o alcaldía</label>
                                            <span class="text-mtv-text-gray uppercase">{{ $persona->direccion()->municipio }}</span>
                                        </span>
                                    </div>
                                </x-field-group-card>

                                <x-field-group-card title="Descripción del negocio" >
                                    <div class="flex flex-row flex-wrap">
                                        <div class="md:basis-1/4 xs:basis-full mt-3 md:pr-16 md:pl-0 xs:px-8">
                                            <x-input-image-viewer
                                                :id="__('logotipo')"
                                                :name="__('logotipo')"
                                                :image_url="$logotipoUrl"
                                                :readonly="true"
                                            />
                                            <input type="hidden" id="logotipo_path" name="logotipo_path" value="{{ $logotipoUrl ?? '' }}">
                                            <x-perfil-negocio.redes-sociales-links :links="$persona->perfil_negocio->enlacesRedesSociales()" />
                                            <div class="text-center py-4">
                                                <a href="mailto:{{ $persona->email }}"
                                                   class="mtv-button-secondary no-underline py-2 md:text-sm xs:text-xs">
                                                    @svg('ri-mail-send-line', ['class' => 'w-5 h-5 inline-block mr-3'])
                                                    Solicitar información
                                                </a>
                                            </div>
                                        </div>
                                        <div class="md:basis-3/4 xs:basis-full mx-0 text-mtv-gray-2">
                                            <div class="grid grid-cols-3 grid-rows-none gap-y-3 mt-3">
                                                <span class="col-start-1 col-end-2 flex flex-col">
                                                    <label>¿Perteneces a un sector prioritario?</label>
                                                    <span class="text-mtv-text-gray uppercase">{{ $persona->perfil_negocio->grupoPrioritario() }}</span>
                                                </span>
                                                <span class="col-start-2 col-end-3 flex flex-col">
                                                    <label>Tipo</label>
                                                    <span class="text-mtv-text-gray uppercase">{{ $persona->perfil_negocio->tipoPyme() }}</span>
                                                </span>
                                                <span class="col-start-3 col-end-4 flex flex-col">
                                                    <label>Sector</label>
                                                    <span class="text-mtv-text-gray uppercase">{{  $sector}}</span>
                                                </span>
                                                <span class="col-start-1 col-end-2 flex flex-col">
                                                    <label>Giro</label>
                                                    <span class="text-mtv-text-gray uppercase">{{ $categoria_scian }}</span>
                                                </span>
                                                <span class="col-start-2 col-end-4 flex flex-col">
                                                    <label>Nombre comercial de tu negocio</label>
                                                    <span class="text-mtv-text-gray uppercase">{{ $persona->perfil_negocio->nombre_negocio }}</span>
                                                </span>
                                                <span class="col-start-1 col-end-4 flex flex-col">
                                                    <label>Lema de tu negocio</label>
                                                    <span class="text-mtv-text-gray uppercase">{{ $persona->perfil_negocio->lema_negocio }}</span>
                                                </span>
                                                <span class="col-start-1 col-end-4 flex flex-col">
                                                    <label>Descripción de tu negocio</label>
                                                    <span class="text-mtv-text-gray">{{ $persona->perfil_negocio->descripcion_negocio }}</span>
                                                </span>
                                                <span class="col-start-1 col-end-4 flex flex-col">
                                                    <label>Diferencias que distinguen tu negocio</label>
                                                    <span class="text-mtv-text-gray uppercase">
                                                        @php($diferenciadores = $persona->perfil_negocio->diferenciadores)
                                                        @php($diferenciadores = !empty($diferenciadores) ? explode(',', $diferenciadores) : [])
                                                        @foreach($diferenciadores as $dif)
                                                            <span class="inline-block text-mtv-secondary uppercase mr-5">
                                                                {{ $dif }}
                                                            </span>
                                                        @endforeach
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </x-field-group-card>

                                <div class="flex md:flex-row xs:flex-col md:space-x-7 md:space-y-0 xs:space-y-5 xs:space-x-0">
                                    <div class="md:basis-1/2 xs:basis-full">
                                        <x-field-group-card title="Documentos adjuntos">
                                            <div class="flex flex-row flex-wrap md:space-x-7 xs:space-x-0">
                                                @isset($carta_presentacion)
                                                    <x-file-download-link :href="$carta_presentacion->original_url">
                                                        Carta de presentación
                                                    </x-file-download-link>
                                                @endisset

                                                @isset($catalogo_pdf)
                                                    <x-file-download-link :default_icon="false" :href="$catalogo_pdf->original_url">
                                                        @svg('icono_catalogo_PDF', ['class' => 'w-7 h-7 inline-block'])
                                                        Catálogo PDF
                                                    </x-file-download-link>
                                                @endisset
                                            </div>
                                        </x-field-group-card>
                                    </div>

                                    <div class="md:basis-1/2 xs:basis-full">
                                        <x-field-group-card title="Catálogo digital">
                                            <a href="{{ route('proveedor-catalogo-productos.show', [$persona->catalogoProductos->id]) }}"
                                               class="mtv-link-gold font-bold">
                                                @svg('icono_catalogo', ['class' => 'w-7 h-7 inline-block mr-2'])
                                                Catálogo
                                            </a>
                                        </x-field-group-card>
                                    </div>
                                </div>
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
                            <div class="accordion-body">
                                <x-perfil-negocio.contactos-lista
                                    :persona="$persona"
                                    :readonly="true"
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

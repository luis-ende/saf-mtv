@props(['mode' => 'edit', 'persona' => null, 'cat_paises' => [], 'grupos_prioritarios' => [], 'tipos_pyme' => [],'sectores' => [], 'tipos_vialidad' => null])

@php($cartaPresentacion = isset($persona->perfil_negocio) ? $persona->perfil_negocio->getFirstMedia('documentos') : null)
@php($catalogoProductosPDF = isset($persona->perfil_negocio) ? $persona->perfil_negocio->getFirstMedia('catalogos_pdf') : null)
@php($updateRoute = $mode === 'registro' ? route('registro-perfil-negocio.store') : ($mode === 'edit' ? route('perfil-negocio.update') : ''))

<form method="POST" enctype="multipart/form-data" action="{{ $updateRoute }}">
    @csrf
    <div class="flex flex-col space-y-5">
        <x-field-group-card
            title="Datos de identificación" >
            <div class="flex flex-row text-mtv-text-gray flex-wrap space-y-1">
                <span class="xs:basis-full md:basis-1/4">
                    Persona: <strong class="uppercase">{{ $persona->id_tipo_persona === 'F' ? 'Física' : 'Moral' }}
                    </strong>
                </span>
                <span class="xs:basis-full md:basis-1/4">
                    RFC: <span class="text-gray-700">{{ $persona->rfc }}</span>
                </span>
            @if($persona->id_tipo_persona === 'F')
                <span class="xs:basis-full md:basis-1/4">
                    CURP: <span class="text-gray-700">{{ $persona->tipo_persona->curp }}</span>
                </span>
                <span class="xs:basis-full md:basis-1/4">
                    Fecha nacimiento: <span class="text-gray-700">{{ $persona->tipo_persona->fecha_nacimiento }}</span>
                </span>
                <span class="xs:basis-full md:basis-1/4">
                    Género: <span class="text-gray-700">{{ $persona->tipo_persona->genero }}</span>
                </span>
                <span class="xs:basis-full md:basis-1/4">
                    Nombre: <span class="text-gray-700 uppercase">{{ $persona->nombre_o_razon_social() }}</span>
                </span>
            @elseif($persona->id_tipo_persona === 'M')
                <span class="xs:basis-full md:basis-1/4">
                    Razón social: <span class="text-gray-700 uppercase">{{ $persona->nombre_o_razon_social() }}</span>
                </span>
                <span class="xs:basis-full md:basis-1/4">
                    Fecha constitución: <span class="text-gray-700">{{ $persona->tipo_persona->fecha_constitucion }}</span>
                </span>
            @endif
            </div>
        </x-field-group-card>

        <x-field-group-card
            title="Domicilio" >
            <x-direccion-input
                        :direccion="isset($persona) ? $persona->direccion() : null"
                        :tipos_vialidad="$tipos_vialidad"
                        :cat_paises="$cat_paises"
            />
        </x-field-group-card>

        <x-field-group-card
            title="Descripción del negocio" >
            <x-descripcion-negocio-form
                :perfil-negocio="$persona->perfil_negocio"
                :grupos_prioritarios="$grupos_prioritarios"
                :tipos_pyme="$tipos_pyme"
                :sectores="$sectores"
                :mode="$mode" />
        </x-field-group-card >

        <x-field-group-card
            title="Documentos adjuntos">
            <div class="w-full"
                 x-data="{
                    cartaPresentacion: {{ $cartaPresentacion ? "'" . $cartaPresentacion->file_name . "'" : 'null' }},
                    cartaPresentacionURL: '{{ $cartaPresentacion ? $cartaPresentacion->original_url : '' }}',
                }">
                <label class="text-mtv-text-gray font-bold my-3">
                    ¿Quieres subir tu carta de presentación?
                </label>
                <div clasS="flex flex-row flex-wrap">
                    <div class="flex flex-row justify-start text-mtv-gold font-bold border rounded px-3 w-32">
                        <div class="flex flex-row cursor-pointer"
                             @click="$refs.inputCartaPresentacion.click()">
                            @svg('uiw-paper-clip', ['class' => 'h-9 w-9 mr-3'])
                            <span class="w-full self-center">Adjuntar</span>
                            <input id="carta_presentacion" name="carta_presentacion"
                                   class="invisible"
                                   type="file" accept="application/pdf"
                                   x-ref="inputCartaPresentacion"
                                   @change="cartaPresentacion = $event.target.value.replace(/^.*[\\\/]/, '')">
                            <input id="eliminar_carta"
                                   name="eliminar_carta"
                                   type="hidden"
                                   x-bind:value="cartaPresentacion === null ? 1 : 0">
                        </div>
                    </div>
                    <div class="text-mtv-text-gray ml-5 self-center" x-show="cartaPresentacion !== null">
                        <a x-show="cartaPresentacionURL !== ''" x-bind:href="cartaPresentacionURL"
                           class="mtv-link-download-gold"
                           x-text="cartaPresentacion"
                           target="_blank"></a>
                        <label class="mtv-link-download-gold"
                               x-show="cartaPresentacionURL === ''"
                               x-text="cartaPresentacion"></label>
                        @svg('sui-cross', [
                            'class' => 'h-3 w-3 inline-block ml-3 mtv-link-download-gold',
                            '@click' => "document.getElementById('carta_presentacion').value = null; cartaPresentacion = null"
                        ])
                    </div>
                </div>
            </div>

            <div class="w-full"
                 x-data="{
                    catalogoProductosPDF: {{ $catalogoProductosPDF ? "'" . $catalogoProductosPDF->file_name . "'" : 'null' }},
                    catalogoProductosURL: '{{ $catalogoProductosPDF ? $catalogoProductosPDF->original_url : '' }}',
                }">
                <label class="text-mtv-text-gray font-bold my-3">
                    ¿Tienes tus productos en un archivo PDF?
                </label>
                <div clasS="flex flex-row flex-wrap">
                    <div class="flex flex-row justify-start text-mtv-gold font-bold border rounded px-3 w-32">
                        <div class="flex flex-row cursor-pointer"
                             @click="$refs.inputCatalogoProductosPDF.click()">
                            @svg('uiw-paper-clip', ['class' => 'h-9 w-9 mr-3'])
                            <span class="w-full self-center">Adjuntar</span>
                            <input id="catalogo_productos_pdf" name="catalogo_productos_pdf"
                                   class="invisible"
                                   type="file" accept="application/pdf"
                                   x-ref="inputCatalogoProductosPDF"
                                   @change="catalogoProductosPDF = $event.target.value.replace(/^.*[\\\/]/, '')">
                            <input id="eliminar_catalogo_pdf"
                                   name="eliminar_catalogo_pdf"
                                   type="hidden"
                                   x-bind:value="catalogoProductosPDF === null ? 1 : 0">
                        </div>
                    </div>
                    <div class="text-mtv-text-gray ml-5 self-center" x-show="catalogoProductosPDF !== null">
                        <a x-show="catalogoProductosURL !== ''" x-bind:href="catalogoProductosURL"
                           class="mtv-link-download-gold"
                           x-text="catalogoProductosPDF"
                           target="_blank"></a>
                        <label class="mtv-link-download-gold"
                               x-show="catalogoProductosURL === ''"
                               x-text="catalogoProductosPDF"></label>
                        @svg('sui-cross', [
                            'class' => 'h-3 w-3 inline-block ml-3 mtv-link-download-gold',
                            '@click' => "document.getElementById('catalogo_productos_pdf').value = null; catalogoProductosPDF = null"
                        ])
                    </div>
                </div>
            </div>
        </x-field-group-card>
        <label class="text-xs text-mtv-text-gray italic mt-2">Formato PDF de hasta 3MB.</label>

        @if($mode === 'registro')
            <button type="submit" class="mtv-button-secondary my-4 self-end">Guardar y continuar</button>
        @elseif($mode === 'edit')
            <button type="submit" class="mtv-button-secondary self-end">Actualizar</button>
        @endif
    </div>
</form>

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
            <x-perfil-negocio.direccion-input
                        :direccion="isset($persona) ? $persona->direccion() : null"
                        :tipos_vialidad="$tipos_vialidad"
                        :cat_paises="$cat_paises"
            />
        </x-field-group-card>

        <x-field-group-card
            title="Descripción del negocio" >
            <x-perfil-negocio.descripcion-negocio-form
                :perfil-negocio="$persona->perfil_negocio"
                :grupos_prioritarios="$grupos_prioritarios"
                :tipos_pyme="$tipos_pyme"
                :sectores="$sectores"
                :mode="$mode" />
        </x-field-group-card >

        <x-field-group-card title="Documentos adjuntos">
            <x-button-upload
                title="¿Quieres subir tu carta de presentación?"
                :file_info="$cartaPresentacion"
                id="carta_presentacion"
                name="carta_presentacion"
                eliminar_input_name="eliminar_carta"
                eliminar_input_id="eliminar_carta"
            />

            <x-button-upload
                title="¿Tienes tus productos en un archivo PDF?"
                :file_info="$catalogoProductosPDF"
                id="catalogo_productos_pdf"
                name="catalogo_productos_pdf"
                eliminar_input_name="eliminar_catalogo_pdf"
                eliminar_input_id="eliminar_catalogo_pdf"
            />
        </x-field-group-card>
        <label class="text-xs text-mtv-text-gray italic mt-2">Formato PDF de hasta 3MB.</label>

        @if($mode === 'registro')
            <button type="submit" class="mtv-button-secondary my-4 self-end">Guardar y continuar</button>
        @elseif($mode === 'edit')
            <button type="submit" class="mtv-button-secondary self-end">Actualizar</button>
        @endif
    </div>
</form>

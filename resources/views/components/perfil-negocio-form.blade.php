@props(['persona' => null, 'grupos_prioritarios' => [], 'tipos_pyme' => [],'sectores' => [], 'tipos_vialidad' => null])

<form method="POST" enctype="multipart/form-data" action="{{ route('registro-perfil-negocio.store') }}">
    @csrf
    <div class="flex flex-col space-y-5">
        <x-field-group-card
            title="Datos de identificación"
        >
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
            @elseif ($persona->id_tipo_persona === 'M')
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
            title="Domicilio de tu negocio"
        >
            <x-direccion-input
                        :step="null"
                        :direccion="isset($persona) ? $persona->direccion() : null"
                        :tipos_vialidad="$tipos_vialidad"
            />
        </x-field-group-card>

        <x-field-group-card
            title="Describe tu negocio"
        >
            <x-descripcion-negocio-form
                :perfil-negocio="$persona->perfil_negocio"
                :grupos_prioritarios="$grupos_prioritarios"
                :tipos_pyme="$tipos_pyme"
                :sectores="$sectores"
                :mode="__('edit')"
            />
        </x-field-group-card>

        <button type="submit" class="mtv-button-secondary my-4 self-end">Guardar y continuar</button>
    </div>
</form>

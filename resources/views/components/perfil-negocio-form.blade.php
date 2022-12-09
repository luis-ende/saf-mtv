@props(['persona' => null, 'grupos_prioritarios' => [], 'tipos_pyme' => [],'sectores' => [], 'tipos_vialidad' => null])

<div>
    <div class="flex flex-col space-y-5">
        <x-field-group-card
            title="Datos de identificación"
        >
            <div class="row text-mtv-text-gray">
                <span class="col-md-3"><label>Persona: </label></span>
                <span class="col-md-3"><label>CURP: </label></span>
                <span class="col-md-3"><label>RFC: </label></span>
                <span class="col-md-3"><label>Nombre: </label></span>
                <span class="col-md-3"><label>Fecha nacimiento: </label></span>
                <span class="col-md-3"><label>Género: </label></span>
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
    <div>
</div>
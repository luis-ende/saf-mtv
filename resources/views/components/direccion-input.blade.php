@props(['tipos_vialidad' => [], 'step' => []])

@php($cp = isset($persona) ? $persona->cp : ( isset($step) ? $step['cp'] : old('cp')))
@php($tipoVialidadId = isset($persona) ? $persona->id_tipo_vialidad : ( isset($step) ? $step['id_tipo_vialidad'] : old('id_tipo_vialidad')))
@php($vialidad = isset($persona) ? $persona->vialidad : ( isset($step) ? $step['vialidad'] : old('vialidad')))
@php($numExt = isset($persona) ? $persona->num_ext : ( isset($step) ? $step['num_ext'] : old('num_ext')))
@php($numInt = isset($persona) ? $persona->num_int : ( isset($step) ? $step['num_int'] : old('num_int')))

<div x-data="domicilioDetalles()" class="row g-3" x-init="refreshCPAsentamiento(); isLoading = false;">
    <input type="hidden" id="id_asentamiento" x-bind:value="asentamientoSeleccion" name="id_asentamiento">
    <div class="form-group col-md-3">
        <label for="cp">Código postal:</label>
        <span x-show="isLoading" class="spinner-border spinner-border-sm text-primary" role="status" aria-hidden="true"></span>
        <input type="text" class="form-control" maxlength="8" id="cp" name="cp" x-model="cpText" required
               oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
               @blur="refreshCPAsentamiento()"
        >
    </div>
    <div class="form-group col-md-3">
        <label for="entidad_federativa">Entidad federativa:</label>
        <select x-model="asentamientoSeleccion" class="form-control" id="entidad_federativa" name="entidad_federativa" required>
            <template x-for="entidad in entidades" :key="entidad.id">
                <option :value="entidad.id" x-text="entidad.nombre"></option>
            </template>
        </select>
    </div>
    <div class="form-group col-md-3">
        <label for="alcaldia">Alcaldía:</label>
        <select x-model="asentamientoSeleccion" class="form-control" id="alcaldia" name="alcaldia" required>
            <template x-for="alcaldia in alcaldias" :key="alcaldia.id">
                <option :value="alcaldia.id" x-text="alcaldia.nombre"></option>
            </template>
        </select>
    </div>
    <div class="form-group col-md-3">
        <label for="colonia">Colonia:</label>
        <select x-model="asentamientoSeleccion" class="form-control" id="colonia" name="colonia" required>
            <template x-for="colonia in colonias" :key="colonia.id">
                <option :value="colonia.id" x-text="colonia.nombre"></option>
            </template>
        </select>
    </div>
    <div class="form-group col-md-3">
        <label for="id_tipo_vialidad">Tipo vialidad:</label>
        <select class="form-control" id="id_tipo_vialidad" name="id_tipo_vialidad"
                x-on:change="tipoVialidad = $event.target.options[$event.target.selectedIndex].text" required>
            <option selected value="0"> -- Selecciona -- </option>
            @foreach ((array) $tipos_vialidad as $tipo_vialidad)
                <option
                    value={{ $tipo_vialidad['id'] }}
                    {{ $tipo_vialidad['id'] == $tipoVialidadId ? 'selected' : '' }}
                >{{ $tipo_vialidad['tipo_vialidad'] }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-md-3">
        <label for="vialidad" x-text="tipoVialidad.charAt(0).toUpperCase() + tipoVialidad.toLowerCase().slice(1) + ':'"></label>
        <input type="text" class="form-control" id="vialidad" name="vialidad" required value="{{ $vialidad }}">
    </div>
    <div class="form-group col-md-3">
        <label for="num_ext">Número exterior:</label>
        <input type="text" class="form-control" id="num_ext" name="num_ext" required value="{{ $numExt }}">
    </div>
    <div class="form-group col-md-3">
        <label for="num_int">Número interior:</label>
        <input type="text" class="form-control" id="num_int" name="num_int" value="{{ $numInt }}">
    </div>
</div>

<script type="text/javascript">
    function domicilioDetalles() {
        return {
            tipoVialidad: 'Vialidad',
            cpText: '{{ $cp }}',
            fields: [],
            asentamientoSeleccion: null,
            entidades: [],
            alcaldias: [],
            colonias: [],
            vialidades: [],
            isLoading: false,

            refreshCPAsentamiento() {
                this.isLoading = true;

                if (this.cpText !== '') {
                    fetch('/api/contacto/asentamientos/' + this.cpText)
                        .then((res) => res.json())
                        .then((res) => {
                            this.isLoading = false;
                            this.entidades = [];
                            this.alcaldias = [];
                            this.colonias = [];

                            res.forEach(asentamiento => {
                                if(!this.entidades.find(item => item.nombre === asentamiento.entidad)) {
                                    this.entidades.push({
                                        'id': asentamiento.id,
                                        'nombre': asentamiento.entidad,
                                    });
                                }
                                if(!this.alcaldias.find(item => item.nombre === asentamiento.alcaldia)) {
                                    this.alcaldias.push({
                                        'id': asentamiento.id,
                                        'nombre': asentamiento.alcaldia,
                                    });
                                }
                                if(!this.colonias.find(item => item.nombre === asentamiento.colonia)) {
                                    this.colonias.push({
                                        'id': asentamiento.id,
                                        'nombre': asentamiento.colonia,
                                    });
                                }
                                if (this.colonias.length > 0) {
                                    this.asentamientoSeleccion = this.colonias[0].id;
                                }
                            });
                            this.rfcExisteEnPadronProveedores = res[0] === 1;
                        });
                }
            },
        }
    }
</script>

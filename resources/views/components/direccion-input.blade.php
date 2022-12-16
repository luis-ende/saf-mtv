@props(['tipos_vialidad' => [], 'cat_paises' => [], 'direccion' => null])

@php($idPais = isset($direccion) ? $direccion->id_pais : old('id_pais'))
@php($idAsentamiento = isset($direccion) ? $direccion->id_asentamiento : old('id_asentamiento'))
@php($cp = isset($direccion) ? $direccion->cp : old('cp'))
@php($tipoVialidadId = isset($direccion) ? $direccion->id_tipo_vialidad : old('id_tipo_vialidad'))
@php($vialidad = isset($direccion) ? $direccion->vialidad : old('vialidad'))
@php($numExt = isset($direccion) ? $direccion->num_ext : old('num_ext'))
@php($numInt = isset($direccion) ? $direccion->num_int : old('num_int'))

@isset($tipoVialidadId)
    @foreach($tipos_vialidad as $tv)
        @if($tv->id === $tipoVialidadId)
            @php($tipoVialidad = $tv->tipo_vialidad)
        @endif
    @endforeach
@endisset

<div x-data="domicilioDetalles()" class="row" x-init="refreshCPAsentamiento(); isLoading = false; ">
    <input type="hidden" id="id_asentamiento" x-bind:value="asentamientoSeleccion" name="id_asentamiento">
    <div class="form-group col-md-3">
        <div class="mtv-input-wrapper">
            <select class="mtv-text-input" id="id_pais" name="id_pais">
                @php($paisDefault = !$idPais ? 'Mexico' : null)
                @foreach($cat_paises as $pais)
                    <option value={{ $pais->id }} 
                        {{ ($pais->id === $idPais) || ($pais->pais === $paisDefault) ? 'selected' : '' }}>
                        {{ $pais->pais }}
                    </option>
                @endforeach                
            </select>
            <label class="mtv-input-label" for="entidad_federativa">País</label>
        </div>
    </div>
    <div class="form-group col-md-3">                
        <span x-show="isLoading" class="spinner-border spinner-border-sm text-primary" role="status" aria-hidden="true"></span>
        <div class="mtv-input-wrapper">
            <input type="text" class="mtv-text-input" maxlength="8" id="cp" name="cp" x-model="cpText" required
                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                @keyup="errorMessage = ''"
                @blur="refreshCPAsentamiento()">
            <label class="mtv-input-label" for="cp">Código postal</label>
        </div>
        <label x-show="errorMessage != ''" x-text="errorMessage" class="text-sm text-red-600 space-y-1"></label>
    </div>    
    <div class="form-group col-md-3">
        <div class="mtv-input-wrapper">        
            <select x-model="asentamientoSeleccion" class="mtv-text-input" id="alcaldia" name="alcaldia">
                <template x-for="alcaldia in alcaldias" :key="alcaldia.id">
                    <option :value="alcaldia.id" x-text="alcaldia.nombre"></option>
                </template>
            </select>
            <label class="mtv-input-label" for="alcaldia">Alcaldía</label>
        </div>    
    </div>
    <div class="form-group col-md-3">
        <div class="mtv-input-wrapper">
            <select x-model="asentamientoSeleccion" class="mtv-text-input" id="colonia" name="colonia">
                <template x-for="colonia in colonias" :key="colonia.id">
                    <option :value="colonia.id" x-text="colonia.nombre"></option>
                </template>
            </select>
            <label class="mtv-input-label" for="colonia">Colonia</label>
        </div>
    </div>
    <div class="form-group col-md-3">
        <div class="mtv-input-wrapper">
            <select class="mtv-text-input" id="id_tipo_vialidad" name="id_tipo_vialidad" x-model="idTipoVialidad"
                    x-on:change="tipoVialidad = $event.target.options[$event.target.selectedIndex].text" required>
                <option value="0"> -- Selecciona -- </option>
                @foreach ($tipos_vialidad as $tipo_vialidad)
                    <option value={{ $tipo_vialidad->id }}>
                        {{ $tipo_vialidad->tipo_vialidad }}
                    </option>
                @endforeach
            </select>
            <label class="mtv-input-label" for="id_tipo_vialidad">Tipo vialidad</label>
        </div>
    </div>
    <div class="form-group col-md-3">
        <div class="mtv-input-wrapper">        
            <input type="text" class="mtv-text-input" id="vialidad" name="vialidad" required value="{{ $vialidad }}">
            <label class="mtv-input-label" for="vialidad" x-text="obtieneTipoVialidadLabel()"></label>
        </div>
    </div>
    <div class="form-group col-md-3">
        <div class="mtv-input-wrapper">                
            <input type="text" class="mtv-text-input" id="num_ext" name="num_ext" required value="{{ $numExt }}">
            <label class="mtv-input-label" for="num_ext">Número exterior</label>
        </div>
    </div>
    <div class="form-group col-md-3">
        <div class="mtv-input-wrapper">                        
            <input type="text" class="mtv-text-input" id="num_int" name="num_int" value="{{ $numInt }}">
            <label class="mtv-input-label" for="num_int">Número interior</label>
        </div>
    </div>
</div>

<script type="text/javascript">
    function domicilioDetalles() {
        return {
            idTipoVialidad: {{ $tipoVialidadId ?? '0' }},
            tipoVialidad: '{{ $tipoVialidad ?? "Vialidad" }}',
            cpText: '{{ $cp }}',
            asentamientoSeleccion: null,
            entidades: [],
            alcaldias: [],
            colonias: [],
            isLoading: false,
            errorMessage: '',

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

                            if (res.length === 0) {
                               this.errorMessage = 'No se encontraron asentamientos asociados al CP';
                               this.asentamientoSeleccion = null;
                            }

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
                                    this.asentamientoSeleccion = {{ $idAsentamiento ?? 'null' }};
                                }
                            });

                            if (res.length >= 1) {
                                this.asentamientoSeleccion = res[0]['id'];
                            }
                        });
                }
            },
            obtieneTipoVialidadLabel() {
                return this.tipoVialidad.charAt(0).toUpperCase() + this.tipoVialidad.toLowerCase().slice(1);
            }
        }
    }
</script>

@props(['tipos_vialidad' => []])

<div x-data="domicilioDetalles()" class="row g-3">
    <div class="form-group col-md-3">
        <label for="cp">Código postal:</label>
        <input type="text" class="form-control" maxlength="8" id="cp" name="cp" x-model="cpText"
               oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
               @blur="refresh()">
    </div>
    <div class="form-group col-md-3">
        <label for="entidad_federativa">Entidad federativa:</label>
        <select x-model="entidadSeleccionada" class="form-control" id="entidad_federativa" name="entidad_federativa" required>
            <template x-for="entidad in entidades" :key="entidad">
                <option :value="entidad" x-text="entidad"></option>
            </template>
        </select>
    </div>
    <div class="form-group col-md-3">
        <label for="alcaldia">Alcaldía:</label>
        <select x-model="entidadSeleccionada" class="form-control" id="alcaldia" name="alcaldia" required>
            <template x-for="alcaldia in alcaldias" :key="alcaldia">
                <option :value="alcaldia" x-text="alcaldia"></option>
            </template>
        </select>
    </div>
    <div class="form-group col-md-3">
        <label for="colonia">Colonia:</label>
        <select x-model="entidadSeleccionada" class="form-control" id="colonia" name="colonia" required>
            <template x-for="colonia in colonias" :key="colonia">
                <option :value="colonia" x-text="colonia"></option>
            </template>
        </select>
    </div>
    <div class="form-group col-md-3">
        <label for="tipo_vialidad">Tipo vialidad:</label>
        <select class="form-control" id="tipo_vialidad" name="tipo_vialidad"  x-on:change="tipoVialidad = $event.target.value" >
            <option selected value="Vialidad"> -- Selecciona -- </option>
            @foreach ((array) $tipos_vialidad as $tipo_vialidad)
                <option value={{ $tipo_vialidad }}>{{ $tipo_vialidad }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-md-3">
        <label for="vialidad" x-text="tipoVialidad"></label>
        <input type="text" class="form-control" id="vialidad" name="vialidad">
    </div>
    <div class="form-group col-md-3">
        <label for="num_ext">Número exterior:</label>
        <input type="text" class="form-control" id="num_ext" name="num_ext">
    </div>
    <div class="form-group col-md-3">
        <label for="num_int">Número interior:</label>
        <input type="text" class="form-control" id="num_int" name="num_int">
    </div>
</div>

<script>
    function domicilioDetalles() {
        return {
            tipoVialidad: 'Vialidad',
            cpText: '',
            fields: [],
            entidadSeleccionada: null,
            entidades: [],
            alcaldias: [],
            colonias: [],
            vialidades: [],
            refresh() {
                fetch('/api/contacto/asentamientos/' + this.cpText)
                    .then((res) => res.json())
                    .then((res) => {
                        console.log(res);

                        this.entidades = [];
                        this.alcaldias = [];
                        this.colonias = [];

                        res.forEach(asentamiento => {
                            if(this.entidades.indexOf(asentamiento.entidad) === -1) {
                                this.entidades.push(asentamiento.entidad);
                            }
                            if(this.alcaldias.indexOf(asentamiento.alcaldia) === -1) {
                                this.alcaldias.push(asentamiento.alcaldia);
                            }
                            if(this.colonias.indexOf(asentamiento.colonia) === -1) {
                                this.colonias.push(asentamiento.colonia);
                            }
                            this.entidades.sort();
                            this.alcaldias.sort();
                            this.colonias.sort();
                        });
                        this.rfcExisteEnPadronProveedores = res[0] === 1;
                    })
            },
        }
    }
</script>

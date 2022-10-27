<script>
    function handler() {
        return {
            fields: [],
            entidadSeleccionada: null,
            entidades: [ 'CDMX', 'Querétaro', 'Chiapas' ], 
            alcaldias: [ 'B. Juárez', 'Coyoacán', 'Tlalpan' ], 
            colonias: ['Colonia 1', 'Colonia 2' ],
            vialidades: ['CALLE', 'CALZADA', 'EJE VIAL'],
            refresh() {
                this.colonias = [];
                this.colonias.push('Colonia X');
                this.colonias.push('Colonia Y');
                this.colonias.push('Colonia W');
            },            
        }
    }
</script>

<div x-data="handler()">
    <div class="form-group">
        <label for="cp">Código postal:</label>
        <input type="text" class="form-control" maxlength="8" id="cp" name="cp" required 
               oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
               @blur="refresh()">
    </div>
    <div class="form-group">
        <label for="entidad_federativa">Entidad federativa:</label>
        <select x-model="entidadSeleccionada" class="form-control" id="entidad_federativa" name="entidad_federativa" required>
            <template x-for="entidad in entidades" :key="entidad">
                <option :value="entidad" x-text="entidad"></option>
            </template>
        </select>    
    </div>
    <div class="form-group">
        <label for="alcaldia">Alcaldía:</label>
        <select x-model="entidadSeleccionada" class="form-control" id="alcaldia" name="alcaldia" required>
            <template x-for="alcaldia in alcaldias" :key="alcaldia">
                <option :value="alcaldia" x-text="alcaldia"></option>
            </template>
        </select>
    </div>
    <div class="form-group">
        <label for="colonia">Colonia:</label>
        <select x-model="entidadSeleccionada" class="form-control" id="colonia" name="colonia" required>        
            <template x-for="colonia in colonias" :key="colonia">
                <option :value="colonia" x-text="colonia"></option>
            </template>
        </select>
    </div>
    <div class="form-group">
        <label for="tipo_vialidad">Tipo vialidad:</label>
        <select class="form-control" id="tipo_vialidad" name="tipo_vialidad">
            <template x-for="vialidad in vialidades" :key="vialidad">
                <option :value="vialidad" x-text="vialidad"></option>
            </template>
        </select>
    </div>
    <div class="form-group">
        <label for="vialidad">Vialidad:</label>
        <input type="text" class="form-control" id="vialidad" name="vialidad">
    </div>
    <div class="form-group">
        <label for="num_ext">Número exterior:</label>
        <input type="text" class="form-control" id="num_ext" name="num_ext">
    </div>
    <div class="form-group">
        <label for="num_int">Número interior:</label>
        <input type="text" class="form-control" id="num_int" name="num_int">
    </div>
</div>
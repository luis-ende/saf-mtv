<div x-data="filtrosFechas()">
    <div class="grid grid-cols-2 grid-rows-2 gap-y-3 gap-x-3 mb-3">
        <button type="button"
                :class="getTrimestreEstilo(1)"
                @click.prevent="setTrimestre(1)">
            Trimestre 1
        </button>
        <input type="hidden" id="fecha_trimestre1_filtro" name="fecha_trimestre1_filtro" x-model="trimestres[1]">
        <button type="button"
                :class="getTrimestreEstilo(2)"
                @click.prevent="setTrimestre(2)">
            Trimestre 2
        </button>
        <input type="hidden" id="fecha_trimestre2_filtro" name="fecha_trimestre2_filtro" x-model="trimestres[2]">
        <button type="button"
                :class="getTrimestreEstilo(3)"
                @click.prevent="setTrimestre(3)">
            Trimestre 3
        </button>
        <input type="hidden" id="fecha_trimestre3_filtro" name="fecha_trimestre3_filtro" x-model="trimestres[3]">
        <button type="button"
                :class="getTrimestreEstilo(4)"
                @click.prevent="setTrimestre(4)">
            Trimestre 4
        </button>
        <input type="hidden" id="fecha_trimestre4_filtro" name="fecha_trimestre4_filtro" x-model="trimestres[4]">
    </div>
    <div class="flex flex-row mb-4 text-mtv-text-gray space-x-3">
        <div class="basis-1/2">
            <label for="fecha_inicio_filtro">Fecha inicial</label>
            <input type="date"
                   id="fecha_inicio_filtro"
                   name="fecha_inicio_filtro"
                   class="w-full mtv-text-input"
                   x-ref="fechaInicio"
                   @change="deseleccionaTrimestres()">
        </div>
        <div class="basis-1/2">
            <label for="fecha_final_filtro">Fecha final</label>
            <input type="date"
                   id="fecha_final_filtro"
                   name="fecha_final_filtro"
                   class="w-full mtv-text-input"
                   x-ref="fechaFinal"
                   @change="deseleccionaTrimestres()">
        </div>
    </div>
</div>
<script type="text/javascript">
    function filtrosFechas() {
        return {
            trimestres: { 1: '0', 2: '0', 3: '0', 4: '0' },
            trimestreActivo: 'font-bold text-white bg-mtv-secondary rounded-lg py-1',
            trimestreInactivo: 'font-bold text-mtv-secondary bg-white border-2 border-mtv-secondary rounded-lg py-1',
            setTrimestre(numTrimestre) {
                this.deseleccionaTrimestres();
                this.trimestres[numTrimestre] = '1';
                this.$refs.fechaInicio.value = null;
                this.$refs.fechaFinal.value = null;
            },
            deseleccionaTrimestres() {
                Object.keys(this.trimestres).forEach(key => this.trimestres[key] = '0');
            },
            getTrimestreEstilo(numTrimestre) {
                return this.trimestres[numTrimestre] === '1' ? this.trimestreActivo : this.trimestreInactivo;
            }
        }
    }
</script>
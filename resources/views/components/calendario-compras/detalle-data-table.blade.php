<div x-data="dataTable">
    <div x-data="procedimientosDataTable()"
         x-init="initProcedimientosDataTable()">
        <div style="overflow-x: auto;" class="h-[600px]">
            <table class="w-full text-xs md:text-sm">
                <thead>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th class="border-b"></th>
                        <th class="border-b text-mtv-text-gray font-normal">Fechas estimadas</th>
                        <th class="border-b"></th>
                    </tr>
                    <tr>
                        <th class="py-2 uppercase text-mtv-primary md:text-lg text-left">
                            <x-calendario-compras.data-table-column-sort
                                    data_column="objeto_contratacion"
                            />
                            Objeto de contratación proyectado
                        </th>
                        <th class="py-2 text-mtv-primary text-center">
                            <x-calendario-compras.data-table-column-sort
                                    data_column="tipo_contratacion"
                            />
                            Tipo de contratación
                        </th>
                        <th class="py-2 text-mtv-primary text-center">
                            <x-calendario-compras.data-table-column-sort
                                    data_column="metodo_contr_proyectado"
                            />
                            Procedimiento de contratación proyectado
                        </th>
                        <th class="py-2 text-mtv-primary text-center">
                            <x-calendario-compras.data-table-column-sort
                                    data_column="fecha_estimada_procedimiento"
                            />
                            Realizar procedimiento de contratación
                        </th>
                        <th class="py-2 text-mtv-primary text-center">
                            <x-calendario-compras.data-table-column-sort
                                    data_column="fecha_estimada_inicio_contr"
                            />
                            Inicio de vigencia del contrato
                        </th>
                        <th class="py-2 text-mtv-primary text-center">
                            <x-calendario-compras.data-table-column-sort
                                    data_column="fecha_estimada_fin_contr"
                            />
                            Finalización del contrato
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <template x-for="(procedimientosRow, index) in $data.rows" :key="index">
                        <tr x-show="$data.checkView(index + 1)"
                            class="border text-mtv-text-gray hover:bg-mtv-text-gray-extra-light">
                            <td class="px-3 uppercase w-[700px]"
                                x-text="procedimientosRow.objeto_contratacion"></td>
                            <td class="px-3 uppercase w-[200px]"
                                x-text="procedimientosRow.tipo_contratacion"></td>
                            <td class="px-3 uppercase w-[300px]"
                                x-text="procedimientosRow.metodo_contr_proyectado"></td>
                            <td class="px-3 text-center w-[200px]"
                                x-text="procedimientosRow.fecha_estimada_procedimiento"></td>
                            <td class="px-3 text-center w-[200px]"
                                x-text="procedimientosRow.fecha_estimada_inicio_contr"></td>
                            <td class="px-3 text-center w-[200px]"
                                x-text="procedimientosRow.fecha_estimada_fin_contr"></td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>

        <!-- Paginador -->
        <x-calendario-compras.data-table-pagination />
    </div>
</div>

@push('scripts')
<script type="text/javascript">
    function procedimientosDataTable() {
        return {
            procedimientos: @js($procedimientos),
            initProcedimientosDataTable() {
                this.$data.dataTableSource = this.procedimientos;
                this.$data.searchOptions.keys.push('objeto_contratacion', 'tipo_contratacion', 'metodo_contr_proyectado');
                this.$data.sorted.field = 'objeto_contratacion';
                this.$data.rows = this.procedimientos.sort(this.$data.sortFunction('objeto_contratacion', 'asc'));
                this.$data.resizePages();

                this.$watch('terminoBusqueda', termino => {
                    this.$data.search(termino);
                    this.$data.resizePages();
                });
            },
        }
    }
</script>
@endpush
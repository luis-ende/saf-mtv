<div style="overflow-x: auto;">
    <table x-data="calendarioDataTable()" class="w-full text-xs md:text-sm">
        <thead>
            <tr>
                <th class="py-2 uppercase text-mtv-primary md:text-lg">
                    <button>
                        @svg('fluentui-arrow-sort-down-lines-24-o', ['class' => 'w-4 h-4 inline-block'])
                    </button>
                    Institución compradora
                </th>
                <th class="py-2 text-mtv-primary text-right">
                    <button>
                        @svg('fluentui-arrow-sort-down-lines-24-o', ['class' => 'w-4 h-4 inline-block'])
                    </button>
                    Ppto. De contratación proyectado
                </th>
                <th class="py-2 text-mtv-primary text-center">
                    <button>
                        @svg('fluentui-arrow-sort-down-lines-24-o', ['class' => 'w-4 h-4 inline-block'])
                    </button>
                    Total Procedimientos
                </th>
                <th class="py-2 text-mtv-primary text-center">
                    Acciones
                </th>
            </tr>
        </thead>
        <tbody>
        <template x-for="(item, index) in compras" :key="index">
            <tr class="border text-mtv-text-gray">
                <td class="px-3 uppercase w-[800px]" x-text="item.unidad_compradora"></td>
                <td class="text-right w-[300px]" x-text="currencyFormat.format(item.presup_contratacion_aprobado)"></td>
                <td class="text-center w-[400px]" x-text="item.total_procedimientos"></td>
                <td class="flex flex-col md:flex-row md:space-x-10 justify-center">
                    <button class="mtv-link-gold no-underline">
                        @svg('heroicon-o-calendar-days', ['class' => 'w-7 h-7'])
                    </button>
                    <button class="mtv-link-gold no-underline">
                        @svg('heroicon-o-calendar-days', ['class' => 'w-7 h-7'])
                    </button>
                    <button class="mtv-link-gold no-underline">
                        @svg('heroicon-o-calendar-days', ['class' => 'w-7 h-7'])
                    </button>
                </td>
            </tr>
        </template>
        </tbody>
    </table>
</div>

<div class="text-mtv-secondary font-bold flex flex-row my-4 justify-center items-center">    
    <button type="button">
        @svg('fas-arrow-left', ['class' => 'w-4 h-4 mr-4'])
    </button>
    1 de 12
    <button type="button">
        @svg('fas-arrow-right', ['class' => 'w-4 h-4 ml-4'])
    </button>
</div>

@push('scripts')
<script type="text/javascript">
    function calendarioDataTable() {
        return {
            currencyFormat: new Intl.NumberFormat('es-MX', { style: 'currency', currency: 'MXN'}),
            compras: @js($compras),
        }
    }
</script>
@endpush
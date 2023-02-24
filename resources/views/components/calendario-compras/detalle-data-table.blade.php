<div style="overflow-x: auto;">
    <table x-data="calendarioDataTable()" 
           x-init="initCalendarioDataTable()"
           class="w-full text-xs md:text-sm">
        <thead>
            <tr>
                <th class="py-2 uppercase text-mtv-primary md:text-lg">
                    <button>
                        @svg('fluentui-arrow-sort-down-lines-24-o', ['class' => 'w-4 h-4 inline-block'])
                    </button>
                    Objeto de contratación proyectado
                </th>
                <th class="py-2 text-mtv-primary text-right">
                    <button>
                        @svg('fluentui-arrow-sort-down-lines-24-o', ['class' => 'w-4 h-4 inline-block'])
                    </button>
                    Tipo de contratación
                </th>
                <th class="py-2 text-mtv-primary text-center">
                    <button>
                        @svg('fluentui-arrow-sort-down-lines-24-o', ['class' => 'w-4 h-4 inline-block'])
                    </button>
                    Procedimiento de contratación proyectado
                </th>                
                <th class="py-2 text-mtv-primary text-center">
                    <button>
                        @svg('fluentui-arrow-sort-down-lines-24-o', ['class' => 'w-4 h-4 inline-block'])
                    </button>
                    Realizar procedimiento de contratación
                </th>                
                <th class="py-2 text-mtv-primary text-center">
                    <button>
                        @svg('fluentui-arrow-sort-down-lines-24-o', ['class' => 'w-4 h-4 inline-block'])
                    </button>
                    Inicio de vigencia del contrato
                </th>                
                <th class="py-2 text-mtv-primary text-center">
                    <button>
                        @svg('fluentui-arrow-sort-down-lines-24-o', ['class' => 'w-4 h-4 inline-block'])
                    </button>
                    Finalización del contrato
                </th>                
            </tr>
        </thead>
        <tbody>
        {{-- <template x-for="(comprasRow, index) in compras" :key="index">
            <tr x-show="comprasRow.visible" 
                class="border text-mtv-text-gray hover:bg-mtv-text-gray-extra-light">
                <td class="px-3 uppercase w-[800px]" x-text="comprasRow.unidad_compradora"></td>
                <td class="text-right w-[300px]" x-text="currencyFormat.format(comprasRow.presup_contratacion_aprobado)"></td>
                <td class="text-center w-[400px]" x-text="comprasRow.total_procedimientos"></td>
                <td class="flex flex-col md:flex-row md:space-x-10 justify-center">
                    <button class="mtv-link-gold no-underline">
                        @svg('heroicon-o-calendar-days', ['class' => 'w-7 h-7'])
                    </button>
                    <button class="mtv-link-gold no-underline">
                        @svg('export_pdf', ['class' => 'w-5 h-5'])
                    </button>
                    <button class="mtv-link-gold no-underline">
                        @svg('export_xls', ['class' => 'w-5 h-5'])
                    </button>
                </td>
            </tr>
        </template> --}}
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
            detalles: [],
            initCalendarioDataTable() {
                const detalles = @js($detalles);
                this.detalles = detalles.map(d => {
                    return {
                        ...d,
                        visible: true,
                    }
                });

                // this.$watch('terminoBusqueda', termino => {
                //     this.search(termino);
                // });
            },
            {{-- Buscar sólo en la propiedad del nombre de la unidad compradora --}}
            // search(value) {
            //     this.searchKeyword = value;
            //     if (value.length > 1) {
            //         const options = {                        
            //             keys: ['unidad_compradora'],
            //             includeScore: true,
            //         }
            //         const fuse = new Fuse(this.compras, options);
            //         const scores = fuse.search(value);

            //         this.compras.forEach((u, index) => {
            //             this.compras[index].visible = false;
            //         });

            //         scores.forEach(c => {
            //             if (c.score > 0 && c.score <= 0.6) {
            //                 this.compras[c.refIndex].visible = true;
            //             }
            //         });
            //     } else {
            //         this.compras.forEach((c, index) => {
            //             this.compras[index].visible = true;
            //         });
            //     }
            // },
        }
    }
</script>
@endpush
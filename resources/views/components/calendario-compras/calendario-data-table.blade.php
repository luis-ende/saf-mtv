<div x-data="dataTable">
    <div x-data="calendarioDataTable()"
         x-init="initCalendarioDataTable()">
        <div style="overflow-x: auto;" class="h-96">
            <table class="w-full text-xs md:text-sm">
                <thead>
                <tr>
                    <th class="py-2 uppercase text-mtv-primary md:text-lg">
                        <x-calendario-compras.data-table-column-sort
                                data_column="unidad_compradora"
                        />
                        Institución compradora
                    </th>
                    <th class="py-2 text-mtv-primary text-right">
                        <x-calendario-compras.data-table-column-sort
                                data_column="presup_contratacion_aprobado"
                        />
                        Ppto. De contratación proyectado
                    </th>
                    <th class="py-2 text-mtv-primary text-center">
                        <x-calendario-compras.data-table-column-sort
                                data_column="total_procedimientos"
                        />
                        Total Procedimientos
                    </th>
                    <th class="py-2 text-mtv-primary text-center">
                        Acciones
                    </th>
                </tr>
                </thead>
                <tbody>
                    <template x-for="(comprasRow, index) in $data.rows" :key="index">
                        <tr x-show="checkView(index + 1)"
                            class="border text-mtv-text-gray hover:bg-mtv-text-gray-extra-light"
                            :class="comprasRow.id == rid ? 'bg-amber-50' : ''"
                            :data-id="comprasRow.id">
                            <td class="px-3 uppercase w-[800px]"
                                x-text="comprasRow.unidad_compradora"></td>
                            <td class="text-right w-[300px]"
                                x-text="currencyFormat.format(comprasRow.presup_contratacion_aprobado)"></td>
                            <td class="text-center w-[400px]"
                                x-text="comprasRow.total_procedimientos"></td>
                            <td>
                                <div class="flex flex-col md:flex-row md:space-x-10 justify-center items-center">
                                    <a title="Ir a página de detalle"
                                       :href="'/compras-detalle/' + comprasRow.id + '?rid=' + comprasRow.id + getQueryParams()"
                                       class="mtv-link-gold no-underline">
                                        @svg('heroicon-o-calendar-days', ['class' => 'w-7 h-7'])
                                    </a>
                                    <a href="#"
                                       title="Descargar en formato Pdf"
                                       class="mtv-link-gold no-underline">
                                        @svg('export_pdf', ['class' => 'w-5 h-5'])
                                    </a>
                                    <a href="#"
                                       title="Descargar en formato Excel"
                                       class="mtv-link-gold no-underline">
                                        @svg('export_xls', ['class' => 'w-5 h-5'])
                                    </a>
                                </div>
                            </td>
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
    function calendarioDataTable() {
        return {
            get rid() {
                return this.urlParams.has('rid') ? this.urlParams.get('rid') : null;
            },
            urlParams: new URLSearchParams(window.location.search),
            currencyFormat: new Intl.NumberFormat('es-MX', { style: 'currency', currency: 'MXN'}),
            compras: @js($compras),
            initCalendarioDataTable() {
                this.$data.dataTableSource = this.compras;
                this.$data.searchOptions.keys.push('unidad_compradora');
                this.$data.sorted.field = 'unidad_compradora';
                this.rows = this.compras.sort(this.$data.sortFunction('unidad_compradora', 'asc'));

                this.$watch('filtroLetraInicial', letra => {
                    this.$refs.calendarioSearchInput.value = '';
                    const letrasIniciales = [letra];
                    switch(letra) {
                        case 'A':
                            letrasIniciales.push('\u00c1')
                            break;
                        case 'E':
                            letrasIniciales.push('\u00c9')
                            break;
                        case 'I':
                            letrasIniciales.push('\u00cd')
                            break;
                        case 'O':
                            letrasIniciales.push('\u00d3')
                            break;
                        case 'U':
                            letrasIniciales.push('\u00da')
                            break;
                    }
                    this.rows =
                        this.compras.filter(c => letrasIniciales.includes(c.unidad_compradora.charAt(0)));

                    this.$data.resizePages(1);
                });

                this.$watch('terminoBusqueda', termino => {
                    this.$data.search(termino);
                    this.$data.resizePages(1);
                });

                this.setQueryParams();
                this.$data.resizePages(this.getStartPage());
            },
            getStartPage() {
                let startPage = 1;
                if (this.urlParams.has('cpag')) {
                    startPage = parseInt(this.urlParams.get('cpag'));
                }

                return startPage;
            },
            getQueryParams() {
                let queryParams = '&cpag=' + this.$data.pagination.currentPage;
                if (this.$data.terminoBusqueda !== '') {
                    queryParams += '&tb=' + this.$data.terminoBusqueda;
                }
                if (this.$data.filtroLetraInicial !== '') {
                    queryParams += '&fl=' + this.$data.filtroLetraInicial;
                }

                return queryParams;
            },
            setQueryParams() {
                if (this.urlParams.has('tb')) {
                    this.$data.terminoBusqueda = this.urlParams.get('tb');
                    this.$data.changePage(this.getStartPage());
                }
                if (this.urlParams.has('fl')) {
                    this.$data.filtroLetraInicial = this.urlParams.get('fl');
                    this.$data.changePage(this.getStartPage());
                }
            }
        }
    }
</script>
@endpush
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
            <template x-for="(comprasRow, index) in rows" :key="index">
                <tr x-show="checkView(index + 1)"
                    class="border text-mtv-text-gray hover:bg-mtv-text-gray-extra-light">
                    <td class="px-3 uppercase w-[800px]"
                        x-text="comprasRow.unidad_compradora"></td>
                    <td class="text-right w-[300px]"
                        x-text="currencyFormat.format(comprasRow.presup_contratacion_aprobado)"></td>
                    <td class="text-center w-[400px]"
                        x-text="comprasRow.total_procedimientos"></td>
                    <td>
                        <div class="flex flex-col md:flex-row md:space-x-10 justify-center items-center">
                            <a href="{{ route('compras-detalle.index', [1]) }}"
                               title="Ir a página de detalle"
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
    <div class="text-mtv-secondary font-bold flex flex-row my-4 justify-center items-center">
        <button type="button" @click="changePage(currentPage - 1)">
            @svg('fas-arrow-left', ['class' => 'w-4 h-4 mr-4'])
        </button>
        <span>
            <span x-text="pagination.currentPage"></span> de <span x-text="pagination.lastPage"></span>
        </span>
        <button type="button" @click="changePage(currentPage + 1)">
            @svg('fas-arrow-right', ['class' => 'w-4 h-4 ml-4'])
        </button>
    </div>
</div>

@push('scripts')
<script type="text/javascript">
    function calendarioDataTable() {
        return {
            currencyFormat: new Intl.NumberFormat('es-MX', { style: 'currency', currency: 'MXN'}),
            compras: @js($compras),
            // Paginación y ordenamiento
            rows: [],
            pages: [],
            view: 10,
            offset: 10,
            pagination: {
                total: 0,
                lastPage: 0,
                perPage: 10,
                currentPage: 1,
                from: 1,
                to: 1 * 10
            },
            currentPage: 1,
            sorted: {
                field: 'unidad_compradora',
                rule: 'asc'
            },
            // Paginación y ordenamiento
            initCalendarioDataTable() {
                this.rows = this.compras.sort(this.compareOnKey('unidad_compradora', 'asc'));

                this.$watch('filtroLetraInicial', letra => {
                    // TODO incluir vocales con acento
                    this.$refs.calendarioSearchInput.value = '';
                    this.rows =
                        this.compras.filter(c => c.unidad_compradora.charAt(0) === letra );

                    this.resizePages();
                });

                this.$watch('terminoBusqueda', termino => {
                    this.search(termino);
                    this.resizePages();
                });

                this.resizePages();
            },
            {{-- Buscar sólo en la propiedad del nombre de la unidad compradora --}}
            search(value) {
                this.searchKeyword = value;
                let filteredRows = [];
                if (value.length > 1) {
                    const options = {                        
                        keys: ['unidad_compradora'],
                        includeScore: true,
                    }
                    const fuse = new Fuse(this.compras, options);
                    const scores = fuse.search(value);
                    scores.forEach(c => {
                        if (c.score > 0 && c.score <= 0.6) {
                            filteredRows.push(this.compras[c.refIndex])
                        }
                    });
                } else {
                    filteredRows = this.compras;
                }
                this.rows = filteredRows;
            },
            // Paginación y ordenamiento
            showPages() {
                const pages = []
                let from = this.pagination.currentPage - Math.ceil(this.offset / 2)
                if (from < 1) {
                    from = 1
                }
                let to = from + this.offset - 1
                if (to > this.pagination.lastPage) {
                    to = this.pagination.lastPage
                }
                while (from <= to) {
                    pages.push(from)
                    from++
                }
                this.pages = pages
            },
            changePage(page) {
                if (page >= 1 && page <= this.pagination.lastPage) {
                    this.currentPage = page
                    const total = this.rows.length
                    const lastPage = Math.ceil(total / this.view) || 1
                    const from = (page - 1) * this.view + 1
                    let to = page * this.view
                    if (page === lastPage) {
                        to = total
                    }
                    this.pagination.total = total
                    this.pagination.lastPage = lastPage
                    this.pagination.perPage = this.view
                    this.pagination.currentPage = page
                    this.pagination.from = from
                    this.pagination.to = to
                    this.showPages()
                }
            },
            checkView(index) {
                return !(index > this.pagination.to || index < this.pagination.from)
            },
            sort(field, rule) {
                this.items = this.rows.sort(this.compareOnKey(field, rule))
                this.sorted.field = field
                this.sorted.rule = rule
            },
            compareOnKey(key, rule) {
                return function(a, b) {
                    if (key === 'unidad_compradora' || key === 'presup_contratacion_aprobado' || key === 'total_procedimientos') {
                        let comparison = 0
                        const fieldA = (typeof a[key] === 'string') ? a[key].toUpperCase() : a[key];
                        const fieldB = (typeof b[key] === 'string') ? b[key].toUpperCase() : b[key];
                        if (rule === 'asc') {
                            if (fieldA > fieldB) {
                                comparison = 1;
                            } else if (fieldA < fieldB) {
                                comparison = -1;
                            }
                        } else {
                            if (fieldA < fieldB) {
                                comparison = 1;
                            } else if (fieldA > fieldB) {
                                comparison = -1;
                            }
                        }
                        return comparison
                    }
                }
            },
            resizePages() {
                this.pagination.total = this.rows.length;
                this.pagination.lastPage = Math.ceil(this.rows.length / this.view);
                this.changePage(1)
                this.showPages();
            },
            isEmpty() {
                return !this.pagination.total
            }
            // Paginación y ordenamiento
        }
    }
</script>
@endpush
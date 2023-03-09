<div x-data="dataTable">
    <div x-data="directorioDataTable()"
         x-init="initDirectorioDataTable()">
        <div style="overflow-x: auto;" class="md:h-96">
            <table id="directorio-tabla" class="w-full text-xs md:text-sm">
                <thead>
                <tr>
                    <th class="py-2 uppercase text-mtv-primary md:text-lg">
                        <x-data-table.column-sort
                                data_column="unidad_compradora"
                        />
                        Institución compradora
                    </th>
                    <th class="py-2 text-mtv-primary text-right">
                        <x-data-table.column-sort
                                data_column="nombre"
                        />
                        Nombre
                    </th>
                    <th class="py-2 text-mtv-primary text-center">
                        <x-data-table.column-sort
                                data_column="puesto"
                        />
                        Puesto
                    </th>
                    <th class="py-2 text-mtv-primary text-center">
                        Acciones
                    </th>
                </tr>
                </thead>
                <tbody>
                <template x-for="(funcionarioRow, index) in $data.rows" :key="index">
                    <tr x-show="checkView(index + 1)"
                        class="border text-mtv-text-gray hover:bg-mtv-text-gray-extra-light"
                        :class="funcionarioRow.id == rid ? 'bg-amber-50' : ''"
                        :data-id="funcionarioRow.id">
                        <td class="px-3 uppercase w-[800px]"
                            x-text="funcionarioRow.unidad_compradora"></td>
                        <td class="text-right w-[300px]"
                            x-text="funcionarioRow.nombre"></td>
                        <td class="text-center w-[400px]"
                            x-text="funcionarioRow.puesto"></td>
                        <td>
                            <div class="flex flex-col space-y-3 md:flex-row md:space-x-10 md:space-y-0 justify-center items-center">
                                <button title="Ver información"
                                    class="mtv-link-gold no-underline"
                                    @click="showFuncionarioModal(funcionarioRow.id)">
                                    @svg('vaadin-user-card', ['class' => 'w-7 h-7'])
                                </button>
                                <a title="Ir al calendario de la institución"
                                   :href="'/compras-detalle/' + funcionarioRow.id_unidad_compradora"
                                   class="mtv-link-gold no-underline">
                                    @svg('mtv-o-calendar-days', ['class' => 'w-7 h-7'])
                                </a>
                            </div>
                        </td>
                    </tr>
                </template>
                </tbody>
            </table>
        </div>

        <!-- Paginador -->
        <x-directorio.data-table-pagination />

        <x-directorio.funcionario-modal />
    </div>
</div>

@push('scripts')
    <script type="text/javascript">
        function directorioDataTable() {
            return {
                get rid() {
                    return this.urlParams.has('rid') ? this.urlParams.get('rid') : null;
                },
                urlParams: new URLSearchParams(window.location.search),
                funcionarios: @js($funcionarios),
                queryUpdating: false,
                funcionarioModalForm: new bootstrap.Modal(document.getElementById('funcionarioModal'), { keyboard: true }),
                funcionarioDetalle: null,
                initDirectorioDataTable() {
                    this.$data.dataTableSource = this.funcionarios;
                    this.$data.rows = this.funcionarios;
                    this.$data.searchOptions.keys.push('unidad_compradora', 'nombre', 'puesto');

                    this.$watch('filtroLetraInicial', letra => {
                        this.$data.bloqueoFiltroInicial = true;
                        this.$data.terminoBusqueda = '';
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
                            this.funcionarios.filter(c => letrasIniciales.includes(c.unidad_compradora.charAt(0)));

                        if (this.queryUpdating) {
                            this.$data.resizePages(this.getStartPage());
                            this.queryUpdating = false;
                        } else {
                            this.$data.resizePages(1);
                        }
                    });

                    this.$watch('terminoBusqueda', termino => {
                        if (!this.$data.bloqueoFiltroInicial) {
                            this.$data.search(termino);

                            if (this.queryUpdating) {
                                this.$data.resizePages(this.getStartPage());
                                this.queryUpdating = false;
                            } else {
                                this.$data.resizePages(1);
                            }
                        }
                        this.$data.bloqueoFiltroInicial = false;
                    });

                    this.setQueryParams();
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
                    if (!(this.$data.sorted.field === 'unidad_compradora' &&
                        this.$data.sorted.rule === 'asc')) {
                        queryParams += '&sortf=' + this.$data.sorted.field;
                        queryParams += '&sortd=' + this.$data.sorted.rule;
                    }

                    return queryParams;
                },
                setQueryParams() {
                    let sortField = 'unidad_compradora';
                    let sortRule = 'asc';
                    if (this.urlParams.has('sortf')) {
                        sortField = this.urlParams.get('sortf');
                        sortRule = this.urlParams.get('sortd');
                    }
                    this.$data.sort(sortField, sortRule);

                    if (this.urlParams.has('tb') || this.urlParams.has('fl')) {
                        if (this.urlParams.has('tb')) {
                            this.queryUpdating = true;
                            this.$data.terminoBusqueda = this.urlParams.get('tb');
                        }

                        if (this.urlParams.has('fl')) {
                            this.queryUpdating = true
                            this.$data.filtroLetraInicial = this.urlParams.get('fl');
                        }
                    } else {
                        this.$data.resizePages(this.getStartPage());
                    }
                },
                showFuncionarioModal(funcionarioId) {
                    this.funcionarioDetalle = this.funcionarios.find(item => item.id === funcionarioId);
                    if (this.funcionarioDetalle) {
                        this.funcionarioModalForm.show();
                    }
                },
                formatoFechaActualizacion(fecha) {
                    const dateToFormat = new Date(fecha);

                    return dateToFormat.toLocaleString('es-MX', { year: 'numeric', month: 'long', day: 'numeric' })
                }
            }
        }
    </script>
@endpush
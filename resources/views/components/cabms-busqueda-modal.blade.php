<!-- Modal -->
<div class="modal modal-lg fade" id="cabmsModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" x-data="dataTable()" x-init="initModalForm()">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Búsqueda de claves CABMS</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                    <div class="container mx-auto w-full h-full">
                        <div class="max-w-screen-lg mx-auto w-full h-full flex flex-col items-center justify-center">
                            <div class="bg-white p-5 shadow-md w-full flex flex-col">
                                <div class="flex justify-between items-center">
                                    <div class="flex space-x-2 items-center">
                                        <label for="select-view">Mostrar</label>
                                        <select id="select-view" x-model="view" @change="changeView()" class="form-control px-4 py-1 border rounded focus:outline-none">
                                            <option value="5">5</option>
                                            <option value="10">10</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                        </select>
                                    </div>
                                    <div>
                                        <input id="input-search" @keydown.enter="search($event.target.value)"
                                               type="text" class="form-control px-2 py-1 border rounded focus:outline-none"
                                               placeholder="Buscar (presiona ENTER)..." autofocus>
                                    </div>
                                </div>
                                <div x-show="loading">
                                    <div class="d-flex justify-content-center">
                                        <div class="spinner-grow text-secondary" role="status">
                                            <span class="visually-hidden">Cargando...</span>
                                        </div>
                                    </div>
                                </div>
                                <table class="mt-5" x-show="!loading">
                                    <thead class="border-b-2">
                                    <th width="5%">
                                        <div class="flex space-x-2">
                                        </div>
                                    </th>
                                    <th width="20%">
                                        <div class="flex space-x-2">
                                          <span>
                                            Clave CABMS
                                          </span>
                                            </span>
                                            <div class="flex flex-col">
                                                <svg @click="sort('clave_cabms', 'asc')" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="4" viewBox="0 0 24 24" stroke="currentColor" class="h-3 w-3 cursor-pointer text-gray-500 fill-current" x-bind:class="{'text-primary': sorted.field === 'clave_cabms' && sorted.rule === 'asc'}"><path d="M5 15l7-7 7 7"></path></svg>
                                                <svg @click="sort('clave_cabms', 'desc')" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="4" viewBox="0 0 24 24" stroke="currentColor" class="h-3 w-3 cursor-pointer text-gray-500 fill-current" x-bind:class="{'text-primary': sorted.field === 'clave_cabms' && sorted.rule === 'desc'}"><path d="M19 9l-7 7-7-7"></path></svg>
                                            </div>
                                        </div>
                                    </th>
                                    <th width="70%">
                                        <div class="flex items-center space-x-2">
                                          <span class="">
                                            Concepto
                                          </span>
                                            <div class="flex flex-col">
                                                <svg @click="sort('concepto_cabms', 'asc')" fill="none" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="4" viewBox="0 0 24 24" stroke="currentColor" class="text-gray-500 h-3 w-3 cursor-pointer fill-current" x-bind:class="{'text-blue-500': sorted.field === 'concepto_cabms' && sorted.rule === 'asc'}"><path d="M5 15l7-7 7 7"></path></svg>
                                                <svg @click="sort('concepto_cabms', 'desc')" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="4" viewBox="0 0 24 24" stroke="currentColor" class="text-gray-500 h-3 w-3 cursor-pointer fill-current" x-bind:class="{'text-blue-500': sorted.field === 'concepto_cabms' && sorted.rule === 'desc'}"><path d="M19 9l-7 7-7-7"></path></svg>
                                            </div>
                                        </div>
                                    </th>
                                    <th width="5%">
                                        <div class="flex items-center space-x-2">
                                          <span class="">
                                            P. P.
                                          </span>
                                            <div class="flex flex-col">
                                                <svg @click="sort('partida_especifica', 'asc')" fill="none" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="4" viewBox="0 0 24 24" stroke="currentColor" class="text-gray-500 h-3 w-3 cursor-pointer fill-current" x-bind:class="{'text-blue-500': sorted.field === 'partida_especifica' && sorted.rule === 'asc'}"><path d="M5 15l7-7 7 7"></path></svg>
                                                <svg @click="sort('partida_especifica', 'desc')" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="4" viewBox="0 0 24 24" stroke="currentColor" class="text-gray-500 h-3 w-3 cursor-pointer fill-current" x-bind:class="{'text-blue-500': sorted.field === 'partida_especifica' && sorted.rule === 'desc'}"><path d="M19 9l-7 7-7-7"></path></svg>
                                            </div>
                                        </div>
                                    </th>
                                    </thead>
                                    <tbody>
                                    <template x-for="(item, index) in items" :key="index">
                                        <tr x-show="checkView(index + 1)" class="hover:bg-gray-200 text-gray-900 text-xs">
                                            <td class="py-3">
                                                <input type="checkbox" x-bind:value="item.clave_cabms" x-model="checkedItems">
                                            </td>
                                            <td class="py-3">
                                                <span x-text="item.clave_cabms"></span>
                                            </td>
                                            <td class="py-3">
                                                <span x-text="item.concepto_cabms"></span>
                                            </td>
                                            <td class="py-3">
                                                <span x-text="item.partida_especifica"></span>
                                            </td>
                                        </tr>
                                    </template>
                                    <tr x-show="isEmpty()">
                                        <td colspan="5" class="text-center py-3 text-gray-900 text-sm">Búsqueda sin resultados.</td>
                                    </tr>
                                    </tbody>
                                </table>
                                <div class="flex mt-5">
                                    <div class="border px-2 cursor-pointer" @click.prevent="changePage(1)">
                                        <span class="text-gray-700">Primero</span>
                                    </div>
                                    <div class="border px-2 cursor-pointer" @click="changePage(currentPage - 1)">
                                        <span class="text-gray-700"><</span>
                                    </div>
                                    <template x-for="item in pages">
                                        <div @click="changePage(item)" class="border px-2 cursor-pointer" x-bind:class="{ 'bg-gray-300': currentPage === item }">
                                            <span class="text-gray-700" x-text="item"></span>
                                        </div>
                                    </template>
                                    <div class="border px-2 cursor-pointer" @click="changePage(currentPage + 1)">
                                        <span class="text-gray-700">></span>
                                    </div>
                                    <div class="border px-2 cursor-pointer" @click.prevent="changePage(pagination.lastPage)">
                                        <span class="text-gray-700">Último</span>
                                    </div>
                                    <div x-show="!isEmpty()">
                                        <span x-text="items.length + ' claves encontradas'" colspan="5" class="text-center px-3 text-gray-600 text-sm"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <script>
                    let cabmsData = []
                </script>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary"
                        @click="clickSeleccionar()">
                    @svg('bi-check-circle-fill', ['class' => 'h-4 w-4 inline-block mr-1'])
                    Selecionar
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    window.dataTable = function () {
        return {
            loading: false,
            checkedItems: [],
            cabmsModal: new bootstrap.Modal(document.getElementById('cabmsModal'), { keyboard: false }),
            items: [],
            view: 5,
            pages: [],
            offset: 5,
            pagination: {
                total: 0,
                lastPage: 0,
                perPage: 5,
                currentPage: 1,
                from: 1,
                to: 1 * 5
            },
            currentPage: 1,
            sorted: {
                field: 'clave_cabms',
                rule: 'asc'
            },
            initData() {
                this.items = cabmsData.sort(this.compareOnKey('concepto_cabms', 'asc'))
                this.pagination.total = this.items.length
                this.pagination.lastPage = Math.ceil(this.items.length / this.view)
            },
            compareOnKey(key, rule) {
                return function(a, b) {
                    if (key === 'clave_cabms' || key === 'concepto_cabms' || key === 'partida_especifica') {
                        let comparison = 0
                        const fieldA = a[key].toUpperCase()
                        const fieldB = b[key].toUpperCase()
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
            checkView(index) {
                return index > this.pagination.to || index < this.pagination.from ? false : true
            },
            checkPage(item) {
                if (item <= this.currentPage + 5) {
                    return true
                }
                return false
            },
            search(value) {
                if (value.length > 1) {
                    this.loading = true;
                    // TODO: Usar variable según tipo de producto: 'B', 'S'
                    fetch('/api/catalogo_cabms/' + 'B/' + value)
                        .then((res) => res.json())
                        .then((json) => {
                            this.loading = false
                            cabmsData = json
                            this.items = cabmsData;
                            this.initData()
                            this.changePage(1)
                        });
                } else {
                    cabmsData = [];
                    this.items = cabmsData
                    this.initData()
                    this.changePage(1)
                }
            },
            sort(field, rule) {
                this.items = this.items.sort(this.compareOnKey(field, rule))
                this.sorted.field = field
                this.sorted.rule = rule
            },
            changePage(page) {
                if (page >= 1 && page <= this.pagination.lastPage) {
                    this.showPages()
                    this.currentPage = page
                    const total = this.items.length
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
                    if (page >= 1 || page === this.pagination.lastPage) {
                        this.showPages()
                    }
                }
            },
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
            changeView() {
                this.changePage(1)
                this.showPages()
            },
            isEmpty() {
                return this.pagination.total ? false : true
            },
            clickSeleccionar() {
                if (this.checkedItems.length > 0) {
                    document.getElementById('clave_cabms').value = this.checkedItems[0];
                }
                this.cabmsModal.hide();
            },
            initModalForm() {
                document.getElementById('cabmsModal').addEventListener('hidden.bs.modal', () => {
                    document.getElementById('input-search').value = '';
                    cabmsData = [];
                    this.items = [];
                    this.checkedItems = [];
                    this.pages = [];
                });
                document.getElementById('cabmsModal').addEventListener('shown.bs.modal', () => {
                    this.initData();
                });
                document.getElementById('cabmsModal').addEventListener('shown.bs.modal', () => {
                    this.loading = false;
                    document.getElementById('input-search').focus();
                });
            }
        }
    }
</script>

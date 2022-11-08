<!-- Modal -->
<div class="modal modal-lg fade" id="cabmsModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" x-data="dataTable()"
             x-init="
        initData()
        $watch('searchInput', value => {
          search(value)
        })" >
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
                                        <p>Mostrar</p>
                                        <select x-model="view" @change="changeView()">
                                            <option value="5">5</option>
                                            <option value="10">10</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                        </select>
                                    </div>
                                    <div>
                                        <input x-model="searchInput" type="text" class="px-2 py-1 border rounded focus:outline-none" placeholder="Buscar...">
                                    </div>
                                </div>
                                <table class="mt-5">
                                    <thead class="border-b-2">
                                    <th width="5%">
                                        <div class="flex space-x-2">
                                          <span>
                                            X
                                          </span>
                                        </div>
                                    </th>
                                    <th width="20%">
                                        <div class="flex space-x-2">
                                          <span>
                                            Clave CABMS
                                          </span>
                                            </span>
                                            <div class="flex flex-col">
                                                <svg @click="sort('clave_cabms', 'asc')" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="4" viewBox="0 0 24 24" stroke="currentColor" class="h-3 w-3 cursor-pointer text-gray-500 fill-current" x-bind:class="{'text-blue-500': sorted.field === 'clave_cabms' && sorted.rule === 'asc'}"><path d="M5 15l7-7 7 7"></path></svg>
                                                <svg @click="sort('clave_cabms', 'desc')" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="4" viewBox="0 0 24 24" stroke="currentColor" class="h-3 w-3 cursor-pointer text-gray-500 fill-current" x-bind:class="{'text-blue-500': sorted.field === 'clave_cabms' && sorted.rule === 'desc'}"><path d="M19 9l-7 7-7-7"></path></svg>
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
                                        <td colspan="5" class="text-center py-3 text-gray-900 text-sm">No matching records found.</td>
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
                                </div>
                            </div>
                        </div>
                    </div>
                <script>
                    let data = [{ "clave_cabms": "5131003994", "concepto_cabms": "ESCRITORIO DE MADERA ESTILO NEOCLASICO, S. XIX.XX MADERA,81 X 182 X 103 (BIENES MUEBLES HISTÓRICOS; 3.1.274)", "partida_especifica": "" }, { "clave_cabms": "5131003996", "concepto_cabms": "ESCRITORIO DE MADERA PARA OFICINA C/ 4 CAJONES DE LA EPOCA EN COLOR NATURAL (BIENES MUEBLES ARTÍSTICOS; 2.1.252)", "partida_especifica": "" }, { "clave_cabms": "5131003998", "concepto_cabms": "ESCRITORIO DE MADERA PARA OFICINA CON CAJONES EN COLOR NATURAL Y BARNIZADA CA. SIGLO XX DIMENSIONES: 134 X 86.3 CM. X 79.3 CM. DE ALTURA (BIENES MUEBLES ARTÍSTICOS; 2.1.245)", "partida_especifica": "" }, { "clave_cabms": "5131004000", "concepto_cabms": "ESCRITORIO MUEBLE PARA OFICINA CON 5 CAJONES DE LA EPOCA, RELOJ CON BASE Y PUERTA CON CRISTAL GARIBOLIADO Y LIBRERO CON PUERTAS DE VIDRIO MAD-115,117 Y 118 (BIENES MUEBLES ARTÍSTICOS; 2.1.25)", "partida_especifica": "" }, { "clave_cabms": "5131004002", "concepto_cabms": "ESCRITORIO RECTANGULAR ESTILO NEOCLASICO, S. XIX MADERA LABRADA, 77 X 180 X 98.5 (CLAUSELL) (BIENES MUEBLES HISTÓRICOS; 3.1.269)", "partida_especifica": "" }, { "clave_cabms": "5291000632", "concepto_cabms": "ESCRITORIO PARA MAESTRO.", "partida_especifica": "" }]
                </script>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary"
                        @click="clickSeleccionar()">Selecionar</button>
            </div>
        </div>
    </div>
</div>

<script>
    window.dataTable = function () {
        return {
            checkedItems: [],
            cabmsModal: new bootstrap.Modal(document.getElementById('cabmsModal'), { keyboard: false }),
            items: [],
            view: 5,
            searchInput: '',
            pages: [],
            offset: 5,
            pagination: {
                total: data.length,
                lastPage: Math.ceil(data.length / 5),
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
                this.items = data.sort(this.compareOnKey('clave_cabms', 'asc'))
                this.showPages()
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
                    } else {
                        if (rule === 'asc') {
                            return a.year - b.year
                        } else {
                            return b.year - a.year
                        }
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
                    const options = {
                        isCaseSensitive: false,
                        shouldSort: true,
                        keys: ['clave_cabms', 'concepto_cabms'],
                        threshold: 0.6,
                    }
                    const fuse = new Fuse(data, options)
                    this.items = fuse.search(value).map(elem => elem.item)
                } else {
                    this.items = data
                }
                // console.log(this.items.length)

                this.changePage(1)
                this.showPages()
            },
            sort(field, rule) {
                this.items = this.items.sort(this.compareOnKey(field, rule))
                this.sorted.field = field
                this.sorted.rule = rule
            },
            changePage(page) {
                if (page >= 1 && page <= this.pagination.lastPage) {
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
                    this.showPages()
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
                this.checkedItems = [];
                this.cabmsModal.hide();
            }
        }
    }
</script>

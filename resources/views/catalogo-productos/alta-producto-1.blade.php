<x-app-layout :show_main_menu="false">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-4">
        <div class="bg-white overflow-hidden shadow-sm h-screen">
            @include('catalogo-productos.registro-header',
                       ['titulo' => 'Agrega tu producto',
                        'titulo_icono' => 'polaris-major-add-product',
                        'subtitulo' => '',
                        'texto_secuencia' => 'Paso 1 de 4'])
            <form method="POST" action="{{ route('alta-producto.store', [1]) }}" class="px-6">
                @csrf
                <div class="w-fit mx-auto flex flex-col"
                     x-data="busquedaCABMS()"
                     x-init="$watch('tipoProducto', value => cabmsChoices.clearChoices()); initBusquedaCABMS()">
                    <label class="block basis-full text-xl font-bold text-mtv-secondary mt-4 mb-2 self-center">
                        Identifica tu Bien o Servicio
                    </label>
                    <div class="basis-full flex flex-row w-56 self-center my-5">
                        <x-tipo-producto-radio
                            :tipo_producto="__('B')" />
                    </div>
                    <label class="text-mtv-gray text-lg mb-3">
                        Busca y selecciona la categoría y nombre de tu producto o servicio
                    </label>
                    <div class="mtv-input-wrapper w-3/4 mx-auto">
                        <select class="mtv-text-input"
                                id="id_categoria_scian" name="id_categoria_scian">
                        </select>
                        <label class="mtv-input-label" for="id_categoria_scian">Categoría</label>
                    </div>
                    <div class="mtv-input-wrapper w-3/4 mx-auto">
                        <div class="mtv-input-wrapper">
                            <select class="mtv-text-input text-base"
                                    id="id_cabms"
                                    name="id_cabms"
                                    x-ref="selectCategoriaScian">
                            </select>
                            <label class="mtv-input-label" for="id_cabms">Nombre</label>
                        </div>
                    </div>
                    <button type="submit"
                            class="mtv-button-secondary self-center my-4">
                            Siguiente
                    </button>
                </div>
            </form>
            <script type="text/javascript">
                function busquedaCABMS() {
                    return {
                        tipoProducto: 'B',
                        busquedaCABMSRoute: '/catalogo-cabms/',
                        cabmsChoices: new Choices('#id_cabms', {
                            allowHTML: false,
                            loadingText: 'Cargando...',
                            noChoicesText: 'Sin resultados para elegir',
                            noResultsText: 'No se encontraron resultados',
                            itemSelectText: 'Seleccionar',
                            searchResultLimit: 50,
                            searchFloor: 1,
                            searchChoices: false
                        }),
                        searchTimeOut: 500,
                        typingTimer: null,
                        currentKeyword: '',
                        initBusquedaCABMS() {
                            const cabmsElement = document.getElementById('id_cabms');
                            cabmsElement.addEventListener('search', () => {
                                clearTimeout(this.typingTimer);
                                this.currentKeyword = event.detail.value;
                                this.typingTimer = setTimeout(() => {
                                    this.buscaCABMS(this.currentKeyword);
                                    clearTimeout(this.typingTimer);
                                }, this.searchTimeOut);
                            });
                        },
                        buscaCABMS(keyword) {
                            this.cabmsChoices.clearChoices();
                            this.lastSearchKeyword = keyword;
                            this.cabmsChoices.setChoices(() => {
                                return fetch(
                                    this.busquedaCABMSRoute + keyword + '?tipo_producto=' + this.tipoProducto
                                ).then(function(response) {
                                    return response.json();
                                }).then(function(data) {
                                    return data.map(function(item) {
                                        return {
                                            value: item.id,
                                            label: item.nombre_cabms + ' | ' + item.sector + ' | ' + item.categoria_scian,
                                        };
                                    });
                                });
                            })
                        }
                    }
                }
            </script>
        </div>
    </div>
</x-registro-layout>

@props(['unidades_compradoras' => [], 'seleccion' => []])

<div class="mb-4 flex flex-col space-y-3"
    x-data="unidadesCompradoras()"
    x-init="initUnidadesCompradoras()">
    <input type="text" placeholder="Buscar"
        @keyup="search($event.target.value)"
        class="ml-0 mt-1 w-96 bg-gray-50 border border-gray-300 text-mtv-text-gray text-sm rounded focus:ring-0">
    <div class="h-64 w-96 overflow-y-scroll">
        <ul class="pl-0 mt-1 ml-1 list-none list-outside flex flex-col space-y-2 text-sm" x-id="['unidad-c']">
            <li class="flex flex-row flex-nowrap items-center">
                <input class="mr-2 border focus:ring-mtv-secondary"
                       type="checkbox" id="unidad-c-0"
                       name="unidad_compradora_filtro[]" value="0"
                       :checked="this.unidadesSeleccionadas.includes(0)"
                       @change="if ($event.target.checked) { uncheckAll(); $event.target.checked = true }">
                <label class="font-bold" for="unidad-c-0">Todos</label>
            </li>
            <template x-for="(unidad, index) in unidades" :key="index">
                <li x-show="unidad.visible" class="flex flex-row flex-nowrap items-start">
                    <input class="mr-2 border focus:ring-mtv-secondary"
                        type="checkbox" :id="$id('unidad-c', unidad.id)"
                        name="unidad_compradora_filtro[]"
                        :checked="unidad.checked === 1"
                        x-bind:value="unidad.id"
                        @change="if ($event.target.checked) { document.getElementById('unidad-c-0').checked = false }">
                    <label :for="$id('unidad-c', unidad.id)" x-html="highlightKeyword(unidad.nombre, searchKeyword)"></label>
                </li>
            </template>
        </ul>
    </div>
    @push('scripts')
    <script type="text/javascript">
        function unidadesCompradoras() {
            return {
                unidades: [],
                unidadesSeleccionadas: @js($seleccion),
                unidadBusqueda: '',
                searchKeyword: '',
                initUnidadesCompradoras() {
                    const unidades = @js($unidades_compradoras);
                    this.unidades = unidades.map(u => {
                        return {
                            ...u,
                            visible: true,
                            checked: this.unidadesSeleccionadas.includes(u.id.toString()) ? 1 : 0,
                        }
                    });
                },
                search(value) {
                    this.searchKeyword = value;
                    if (value.length > 1) {
                        const options = {
                            {{-- Buscar sólo en la propiedad del nombre de la unidad --}}
                            keys: ['nombre'],
                            includeScore: true,
                        }
                        const fuse = new Fuse(this.unidades, options);
                        const scores = fuse.search(value);

                        this.unidades.forEach((u, index) => {
                            this.unidades[index].visible = false;
                        });

                        scores.forEach(unidad => {
                            if (unidad.score > 0 && unidad.score <= 0.6) {
                                this.unidades[unidad.refIndex].visible = true;
                            }
                        });
                    } else {
                        this.unidades.forEach((u, index) => {
                            this.unidades[index].visible = true;
                        });
                    }
                },
                highlightKeyword(text, keyword) {
                    if (keyword !== "") {
                        let words = text.split(' ');
                        const fuse = new Fuse(words, { includeScore: true });
                        const scores = fuse.search(keyword);
                        scores.forEach(word => {
                            if (word.score <= 0.3) {
                                words[word.refIndex] = `<mark>${word.item}</mark>`;
                            }
                        });

                        return words.join(' ');
                    }

                    return text;
                },
                uncheckAll() {
                    document.getElementsByName('unidad_compradora_filtro[]').forEach(input => input.checked = false)
                }
            }
        }
    </script>
    @endpush
</div>
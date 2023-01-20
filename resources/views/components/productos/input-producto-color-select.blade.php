@props(['producto_colores' => '', 'lista_colores' => []])

<div class="mtv-input-wrapper w-full mx-auto"
     x-data="inputColores()"
     x-init="initInputColores(); if(productoEditado) { $watch('productoEditado', value => { initInputColores() }) }">
    <select class="mtv-text-input text-base"
            id="producto_colores"
            name="producto_colores[]"
            multiple>
    </select>
    <label class="mtv-input-label" for="producto_colores">Color(es)</label>
</div>

<script type="text/javascript">
    function inputColores() {
        return {
            listaColores: @json($lista_colores),
            inputColoresChoices: new Choices('#producto_colores', {                
                allowHTML: false,
                loadingText: 'Cargando...',
                noChoicesText: 'Sin colores para elegir',
                noResultsText: 'No se encontraron colores',
                itemSelectText: 'Seleccionar color',
                searchChoices: true,
                duplicateItemsAllowed: false,
                removeItemButton: true,
                searchResultLimit: 7,
                classNames: {
                    containerInner: 'choices__inner--categorias choices__inner',
                    item: 'colores__choices__item',
                },
                callbackOnCreateTemplates: function(template) {
                    return {
                        item: ({ classNames }, data) => {
                            return template(`
                                <div style="background-color: ${data.value}" class="${classNames.item} ${
                                data.highlighted
                                    ? classNames.highlightedState
                                    : classNames.itemSelectable
                                } ${
                                data.placeholder ? classNames.placeholder : ''
                                }" data-item data-id="${data.id}" data-value="${data.value}" ${
                                data.active ? 'aria-selected="true"' : ''
                                } ${data.disabled ? 'aria-disabled="true"' : ''}>
                                    <span>&nbsp;&nbsp;&nbsp;</span>
                                </div>
                            `);
                        },
                        choice: ({ classNames }, data) => {
                        return template(`
                                <div class="${classNames.item} ${classNames.itemChoice} ${
                                data.disabled ? classNames.itemDisabled : classNames.itemSelectable
                                }" data-select-text="${this.config.itemSelectText}" data-choice ${
                                data.disabled
                                    ? 'data-choice-disabled aria-disabled="true"'
                                    : 'data-choice-selectable'
                                } data-id="${data.id}" data-value="${data.value}" ${
                                data.groupId > 0 ? 'role="treeitem"' : 'role="option"'
                                }>
                                    <span style="display: inline-block; width: 80px; height: 20px; margin-right: 3px; background-color: ${data.value}"></span>
                                </div>
                            `);
                        },
                    }
                },
            }),
            initInputColores() {
                let productoColores = {!! json_encode($producto_colores) !!};
                productoColores = productoColores.split(',');
                this.inputColoresChoices.clearStore();                
                const colorCodes = Object.keys(this.listaColores);
                const colorLabels = Object.values(this.listaColores);
                this.inputColoresChoices.setChoices(
                    colorCodes.map((item, index) => {
                        return {
                            label: colorLabels[index],
                            value: item,
                            selected: productoColores.includes(item),
                        }
                }));
            }
        }
    }
</script>

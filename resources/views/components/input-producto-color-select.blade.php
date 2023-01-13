@props(['producto_colores' => ''])

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
        const CSS_COLOR_NAMES = [
            "AliceBlue",
            "AntiqueWhite",
            "Aqua",
            "Aquamarine",
            "Azure",
            "Beige",
            "Bisque",
            "Black",
            "BlanchedAlmond",
            "Blue",
            "BlueViolet",
            "Brown",
            "BurlyWood",
            "CadetBlue",
            "Chartreuse",
            "Chocolate",
            "Coral",
            "CornflowerBlue",
            "Cornsilk",
            "Crimson",
            "Cyan",
            "DarkBlue",
            "DarkCyan",
            "DarkGoldenRod",
            "DarkGray",
            "DarkGrey",
            "DarkGreen",
            "DarkKhaki",
            "DarkMagenta",
            "DarkOliveGreen",
            "DarkOrange",
            "DarkOrchid",
            "DarkRed",
            "DarkSalmon",
            "DarkSeaGreen",
            "DarkSlateBlue",
            "DarkSlateGray",
            "DarkSlateGrey",
            "DarkTurquoise",
            "DarkViolet",
            "DeepPink",
            "DeepSkyBlue",
            "DimGray",
            "DimGrey",
            "DodgerBlue",
            "FireBrick",
            "FloralWhite",
            "ForestGreen",
            "Fuchsia",
            "Gainsboro",
            "GhostWhite",
            "Gold",
            "GoldenRod",
            "Gray",
            "Grey",
            "Green",
            "GreenYellow",
            "HoneyDew",
            "HotPink",
            "IndianRed",
            "Indigo",
            "Ivory",
            "Khaki",
            "Lavender",
            "LavenderBlush",
            "LawnGreen",
            "LemonChiffon",
            "LightBlue",
            "LightCoral",
            "LightCyan",
            "LightGoldenRodYellow",
            "LightGray",
            "LightGrey",
            "LightGreen",
            "LightPink",
            "LightSalmon",
            "LightSeaGreen",
            "LightSkyBlue",
            "LightSlateGray",
            "LightSlateGrey",
            "LightSteelBlue",
            "LightYellow",
            "Lime",
            "LimeGreen",
            "Linen",
            "Magenta",
            "Maroon",
            "MediumAquaMarine",
            "MediumBlue",
            "MediumOrchid",
            "MediumPurple",
            "MediumSeaGreen",
            "MediumSlateBlue",
            "MediumSpringGreen",
            "MediumTurquoise",
            "MediumVioletRed",
            "MidnightBlue",
            "MintCream",
            "MistyRose",
            "Moccasin",
            "NavajoWhite",
            "Navy",
            "OldLace",
            "Olive",
            "OliveDrab",
            "Orange",
            "OrangeRed",
            "Orchid",
            "PaleGoldenRod",
            "PaleGreen",
            "PaleTurquoise",
            "PaleVioletRed",
            "PapayaWhip",
            "PeachPuff",
            "Peru",
            "Pink",
            "Plum",
            "PowderBlue",
            "Purple",
            "RebeccaPurple",
            "Red",
            "RosyBrown",
            "RoyalBlue",
            "SaddleBrown",
            "Salmon",
            "SandyBrown",
            "SeaGreen",
            "SeaShell",
            "Sienna",
            "Silver",
            "SkyBlue",
            "SlateBlue",
            "SlateGray",
            "SlateGrey",
            "Snow",
            "SpringGreen",
            "SteelBlue",
            "Tan",
            "Teal",
            "Thistle",
            "Tomato",
            "Turquoise",
            "Violet",
            "Wheat",
            "White",
            "WhiteSmoke",
            "Yellow",
            "YellowGreen",
        ];

        const CSS_COLOR_LABELS = [
            "AliceAzul",
            "AntiqueBlanco",
            "Aqua",
            "Aquamarine",
            "Azure",
            "Beige",
            "Bisque",
            "Black",
            "BlanchedAlmond",
            "Azul",
            "AzulVioleta",
            "Cafe",
            "BurlyWood",
            "CadetAzul",
            "Chartreuse",
            "Chocolate",
            "Coral",
            "CornflowerAzul",
            "Cornsilk",
            "Crimson",
            "Cyan",
            "DarkAzul",
            "DarkCyan",
            "DarkOroRod",
            "DarkGris",
            "DarkGris",
            "DarkVerde",
            "DarkKhaki",
            "DarkMagenta",
            "DarkOlivaVerde",
            "DarkNaranja",
            "DarkOrchid",
            "DarkRojo",
            "DarkSalmon",
            "DarkSeaVerde",
            "DarkSlateAzul",
            "DarkSlateGris",
            "DarkSlateGris",
            "DarkTurquoise",
            "DarkVioleta",
            "DeepRosa",
            "DeepSkyAzul",
            "DimGris",
            "DimGris",
            "DodgerAzul",
            "FireBrick",
            "FloralBlanco",
            "ForestVerde",
            "Fuchsia",
            "Gainsboro",
            "GhostBlanco",
            "Oro",
            "OroRod",
            "Gris",
            "Gris",
            "Verde",
            "VerdeAmarillo",
            "HoneyDew",
            "HotRosa",
            "IndianRojo",
            "Indigo",
            "Ivory",
            "Khaki",
            "Lavender",
            "LavenderBlush",
            "LawnVerde",
            "LemonChiffon",
            "LightAzul",
            "LightCoral",
            "LightCyan",
            "LightOroRodAmarillo",
            "LightGris",
            "LightGris",
            "LightVerde",
            "LightRosa",
            "LightSalmon",
            "LightSeaVerde",
            "LightSkyAzul",
            "LightSlateGris",
            "LightSlateGris",
            "LightSteelAzul",
            "LightAmarillo",
            "Lima",
            "LimaVerde",
            "Linen",
            "Magenta",
            "Maroon",
            "MediumAquaMarine",
            "MediumAzul",
            "MediumOrchid",
            "MediumPurpura",
            "MediumSeaVerde",
            "MediumSlateAzul",
            "MediumSpringVerde",
            "MediumTurquoise",
            "MediumVioletaRojo",
            "MidnightAzul",
            "MintCream",
            "MistyRose",
            "Moccasin",
            "NavajoBlanco",
            "Navy",
            "OldLace",
            "Oliva",
            "OlivaDrab",
            "Naranja",
            "NaranjaRojo",
            "Orchid",
            "PaleOroRod",
            "PaleVerde",
            "PaleTurquoise",
            "PaleVioletaRojo",
            "PapayaWhip",
            "DuraznoPuff",
            "Peru",
            "Rosa",
            "Plum",
            "PowderAzul",
            "Purpura",
            "RebeccaPurpura",
            "Rojo",
            "RosyCafe",
            "RoyalAzul",
            "SaddleCafe",
            "Salmon",
            "SandyCafe",
            "SeaVerde",
            "SeaShell",
            "Sienna",
            "Silver",
            "SkyAzul",
            "SlateAzul",
            "SlateGris",
            "SlateGris",
            "Snow",
            "SpringVerde",
            "SteelAzul",
            "Tan",
            "Teal",
            "Thistle",
            "Tomato",
            "Turquoise",
            "Violeta",
            "Wheat",
            "Blanco",
            "BlancoSmoke",
            "Amarillo",
            "AmarilloVerde",
        ];

        return {
            inputColoresChoices: new Choices('#producto_colores', {
                allowHTML: false,
                loadingText: 'Cargando...',
                noChoicesText: 'Sin colores para elegir',
                noResultsText: 'No se encontraron colores',
                itemSelectText: 'Seleccionar color',
                searchChoices: true,
                duplicateItemsAllowed: false,
                removeItemButton: true,
                searchResultLimit: 20,
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
                this.inputColoresChoices.setChoices(
                    CSS_COLOR_NAMES.map((item, index) => {
                        return {
                            label: CSS_COLOR_LABELS[index],
                            value: item,
                            selected: productoColores.includes(item),
                        }
                }));
            }
        }
    }
</script>

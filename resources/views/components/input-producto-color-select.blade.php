<div class="mtv-input-wrapper w-full mx-auto"
     x-data="inputColores()"
     x-init="initInputColores()">
    <select class="mtv-text-input text-base"
            id="producto_colores"
            name="producto_colores[]"            
            multiple>
    </select>
    <label class="mtv-input-label" for="producto_colores">Color(es)</label>    
</div>
{{-- <label class="text-xs text-slate-500 italic"
       for="color">
    Usa comas para separar las palabras
</label>                         --}}

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
        
        return {
            inputColoresChoices: new Choices('#producto_colores', {
                seleccionColores: [],
                allowHTML: false,
                loadingText: 'Cargando...',
                noChoicesText: 'Sin colores para elegir',
                noResultsText: 'No se encontraron colores',
                itemSelectText: 'Seleccionar color',
                searchChoices: true,
                duplicateItemsAllowed: false,
                removeItemButton: true,
                classNames: {
                    containerInner: 'choices__inner--categorias choices__inner',
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
                                    <span>&#x025A8;</span>
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
                this.inputColoresChoices.setChoices(
                    CSS_COLOR_NAMES.map(item => { return { 
                        label: item, 
                        value: item, 
                    }
                }));                
            }
        }
    }
</script>
import './bootstrap';

import '../sass/app.scss';
import * as bootstrap from 'bootstrap';
window.bootstrap = bootstrap;

import swal from 'sweetalert2';
window.Swal = swal;
window.SwalMTVCustom = {
    customClass: {
        'title': 'swal2-mtv-title swal2-mtv-title-warning',
        'popup': 'swal2-mtv-popup',
        'confirmButton': 'swal2-mtv-confirm-button',
        'cancelButton': 'swal2-mtv-cancel-button',
        'htmlContainer': 'swal2-mtv-html-container',
        'icon': 'swal2-mtv-icon'
    },
    showConfirmButton: true,
    showCancelButton: true,
    confirmButtonText: 'Sí',
    cancelButtonText: 'No',
    allowOutsideClick: false,
}

import choices from 'choices.js';
window.Choices = choices;

import fuse from 'fuse.js';
window.Fuse = fuse;

import Alpine from 'alpinejs';
import mask from '@alpinejs/mask'

Alpine.plugin(mask)

window.Alpine = Alpine;

// Función reutilizable para el componente resources/views/components/cabms-categorias-select.blade.php
// Componente de selección de CABMS y Categorías SCIAN para productos
Alpine.data('busquedaCABMS', () => ({
    tipoProducto: 'B',    
    busquedaCABMSRoute: '/catalogo-cabms/',
    busquedaCategoriasRoute: '/catalogo-cabms/categorias/',
    cabmsChoices: new Choices('#id_cabms', {
        allowHTML: false,
        loadingText: 'Cargando...',
        noChoicesText: 'Sin resultados para elegir',
        noResultsText: 'No se encontraron resultados',
        itemSelectText: 'Seleccionar',
        removeItemButton: true,
        searchResultLimit: 50,
        searchFloor: 1,
        searchChoices: false,
        shouldSort: false, // El backend regresa los resultados ya ordenados por grado de similitud
    }),
    categoriasChoices: new Choices('#categorias_scian', {
        allowHTML: false,
        loadingText: 'Cargando...',
        noChoicesText: 'Sin categorías para elegir',
        noResultsText: 'No se encontraron categorías',
        itemSelectText: 'Seleccionar',
        searchChoices: true,
        duplicateItemsAllowed: false,
        removeItemButton: true,
        classNames: {
            containerInner: 'choices__inner--categorias choices__inner',
        }
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
    },
    buscaCategorias(cabmsId, selectedItems = []) {
        this.categoriasChoices.clearChoices();
        this.categoriasChoices.setChoices(() => {
            return fetch(
                this.busquedaCategoriasRoute + cabmsId
            ).then(function(response) {
                return response.json();
            }).then(function(data) {
                return data.map(function(item) {
                    let choice = {
                        value: item.id,
                        label: item.categoria_scian,
                    };

                    if (selectedItems.includes(item.id)) {
                        choice.selected = true;
                    }

                    return choice;
                });
            });
        });
    },    
    cargaProductoCABMSCategorias(productoId) {        
        this.cabmsChoices.clearStore();
        this.categoriasChoices.clearStore();
        if (productoId) {
            fetch('/productos/' + productoId + '/cabms_categorias')
                .then(res => res.json())
                .then(res => {
                    this.tipoProducto = res.tipo;
                    this.cabmsChoices.setChoices([{
                        value: res.id_cabms,
                        label: res.nombre_cabms + ' | ' + res.sector + ' | ' + res.categoria_scian,
                        selected: true,
                    }]);
                    if (res.id_cabms) {
                        this.buscaCategorias(res.id_cabms, res.ids_categorias_scian);
                    }
                });
        }
    }
}))

Alpine.data('productoFavoritos', () => ({
    get currentColor() {
        let $color = this.numFavoritos > 0 ? 'text-mtv-primary' : 'text-mtv-gold';
        if (this.esEditable) {
            $color += this.numFavoritos > 0 ? ' hover:text-mtv-gold' : ' hover:text-mtv-primary'
        }

        return $color;
    },
    numFavoritos: 0,
    esEditable: false,
    toggleFavorito(updateRoute, token) {
        fetch(updateRoute, {
            method: "POST",
            credentials: 'same-origin',
            headers: {
                'X-CSRF-Token': token,
            },
        }).then(response => response.json())
            .then(json => {
                this.numFavoritos = json.num_favoritos;
            })
    },
    initFavoritos(numFavoritos) {
        this.numFavoritos = numFavoritos;
        if (this.esEditable) {
            this.$watch('numFavoritos', value => {
                this.$refs.controlFavoritos.className = '';
                this.currentColor.split(' ').forEach(favClass => {
                    this.$refs.controlFavoritos.classList.add(favClass);
                });
            })
        }
    }
}))

Alpine.data('infiniteScrolling', () => ({
    get maxResultados() {
        return this.numResults < this.paginationOffset;
    },
    buscadorItemsRoute: null,
    paginationOffset: 0,
    nextOffset: 0,
    htmlData: null,
    numResults: 0,
    filtros: [],
    isLoading: false,
    async retrieveData() {
        // Remueve elementos con valor nulo
        const filtrosValidos = Object.fromEntries(Object.entries(this.filtros).filter(([_, v]) => v != null));
        const filtrosParams = new URLSearchParams(filtrosValidos);
        filtrosParams.append('offset', this.nextOffset);

        this.isLoading = true;
        this.htmlData = await (await fetch(this.buscadorItemsRoute + '?' + filtrosParams, {
            method: 'GET',
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })).text();                
        
        let parser = new DOMParser();
        let parseDocument = parser.parseFromString(this.htmlData, 'text/html');
        this.numResults = parseDocument.getElementsByTagName('article').length;
        this.nextOffset += this.paginationOffset;

        this.isLoading = false;
    },
    initInfiniteScrolling(paginationOffset, numRecords, filtros, buscadorItemsRoute) {
        this.paginationOffset = paginationOffset;
        this.nextOffset = paginationOffset;
        this.numResults = numRecords;
        this.filtros = filtros;
        this.buscadorItemsRoute = buscadorItemsRoute;
        this.$watch('htmlData', value => {
            this.$refs.resultsGrid.innerHTML += this.htmlData
        })
    },
}))

Alpine.data('animatedCounter', (targer, time = 200, start = 0) => ({    
    current: 0,
    target: targer,
    time: time,
    start: start,
    updatecounter: function() {
        start = this.start;
        const increment = (this.target - start) / this.time;
        const handle = setInterval(() => {
        if (this.current < this.target)
            this.current += increment
        else {
            clearInterval(handle);
            this.current = this.target
        }
        }, 1);
    }      
}))

Alpine.data('oportunidadNegocioAlertas', () => ({
    alertaActiva: false,
    toggleAlerta(route, token) {
        fetch(route, {
            method: "POST",
            credentials: 'same-origin',
            headers: {
                'X-CSRF-Token': token,
            },
        }).then(response => response.json())
        .then(json => {
            this.alertaActiva = json.alerta_estatus;
        })
    },
    showMessage() {
        const props = SwalMTVCustom;
        props.customClass['title'] = 'swal2-mtv-title'
        Swal.fire({
            ...SwalMTVCustom,
            title: 'Activar alerta',
            html: "Para activar las alertas debes estar registrado o haber ingresado a Mi Tiendita Virtual." +
                    '<p class="swal-mtv-html-container-action">¿Quieres activar la alerta?</p>',
            confirmButtonText: 'Ingresar',
            cancelButtonText: 'Regístrate',
        });
    }
}))

Alpine.start();

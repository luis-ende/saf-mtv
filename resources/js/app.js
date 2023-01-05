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

import Alpine from 'alpinejs';
import mask from '@alpinejs/mask'

Alpine.plugin(mask)

window.Alpine = Alpine;

Alpine.store('filesUploaded', { hasFilesUploaded: false });

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
                        label: res.nombre_cabms,
                        selected: true,
                    }]);
                    if (res.id_cabms) {
                        this.buscaCategorias(res.id_cabms, res.ids_categorias_scian);
                    }
                });
        }
    }
}))


Alpine.start();

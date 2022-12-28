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

// Función reutilizable para el componente cabms-categorias-select.blade.php
Alpine.data('busquedaCABMS', () => ({
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
}))


Alpine.start();

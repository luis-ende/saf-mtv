import './bootstrap';

import '../sass/app.scss';
import * as bootstrap from 'bootstrap';
window.bootstrap = bootstrap;

import { rfcValido } from "./rfc-validacion";
window.rfcValido = rfcValido;

import swal from 'sweetalert2';
window.Swal = swal;
window.SwalMTVCustom = {
    customClass: {
        'title': 'swal2-mtv-title swal2-mtv-title-warning',
        'popup': 'swal2-mtv-popup',
        'confirmButton': 'swal2-mtv-confirm-button',
        'cancelButton': 'swal2-mtv-cancel-button',
        'htmlContainer': 'swal2-mtv-html-container',
        'icon': 'swal2-mtv-icon',
        'closeButton': 'swal2-close',
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

import { DateTime } from "luxon";

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
            this.$refs.resultsGrid.innerHTML += this.htmlData;            
            document.dispatchEvent(new CustomEvent("infiniteScrollingUpdate", {}));            
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

Alpine.data('oportunidadNegocioBookmarks', () => ({
    get currentColor() {        
        let color = 'text-mtv-secondary';
        if (this.bookmarkActivo) {
            color = 'text-mtv-primary';
        } else {
            if (this.procedimientoCerrado && !this.bookmarkActivo) {
                color = 'text-mtv-gray';
            }            
        }

        return color;
    },
    numBookmarks: 0,
    bookmarkActivo: false,    
    procedimientoCerrado: false,
    esVistaNotif: false,
    toggleBookmark(updateRoute, token) {
        let newState = !this.bookmarkActivo;
        if (newState === false) {
            const props = SwalMTVCustom;
            props.customClass['title'] = 'swal2-mtv-title';        
            Swal.fire({
                ...SwalMTVCustom,
                title: 'Quitar de favoritos',
                html: '<p class="swal-mtv-html-container-action">¿Quieres quitar esta oportunidad de negocio de tus favoritos?</p>',
                confirmButtonText: 'Quitar',
                cancelButtonText: 'Conservar',
                showCloseButton: true,
            }).then((result) => {                        
                if (result.isConfirmed) {
                    this.sendToggleRequest(updateRoute, token);
                }
            });            
        } else {
            if (!this.procedimientoCerrado) {
                this.sendToggleRequest(updateRoute, token);
            }            
        }
        
    },
    sendToggleRequest(updateRoute, token) {        
        fetch(updateRoute, {
            method: "POST",
            credentials: 'same-origin',
            headers: {
                'X-CSRF-Token': token,
            },
        }).then(response => response.json())
        .then(json => {
            this.bookmarkActivo = json.alerta_estatus;
            this.numBookmarks = json.num_bookmarks;            
            if (this.esVistaNotif) {
                window.location.reload();
            }            
        })
    },
    showMessage(rutaLogin, rutaRegistro) {
        if (!this.procedimientoCerrado) {
            const props = SwalMTVCustom;
            props.customClass['title'] = 'swal2-mtv-title';        
            Swal.fire({
                ...SwalMTVCustom,
                title: 'Guardar oportunidad de negocio',
                html: "Para guardar la notificación debes estar registrado o ingresado a Mi Tiendita Virtual." +
                      '<p class="swal-mtv-html-container-action">¿Quieres guardar la oportunidad de negocio?</p>',
                confirmButtonText: 'Ingresar',
                cancelButtonText: 'Registrarte',
                showCloseButton: true,
            }).then((result) => {                        
                if (result.isConfirmed) {
                    window.location.href = rutaLogin;
                } else if (!(result.dismiss === 'close' || result.dismiss === 'esc')) {
                    window.location.href = rutaRegistro;
                }            
            });
        }        
    },
    initBookmarks(numBookmarks, bookmarkActivo, procedimientoCerrado) {
        this.bookmarkActivo = bookmarkActivo;
        this.numBookmarks = numBookmarks;
        this.procedimientoCerrado = procedimientoCerrado;
    }
}))

Alpine.data('oportunidadesFiltrosURLParams', () => ({
    searchParams() {
        const query = new URLSearchParams();
        const termBusqueda = document.getElementById('oportunidades_search').value;
        if (termBusqueda) {
            query.append('tb', termBusqueda);
        }
        this.collectFilter('capitulo_filtro[]', query, 'ca');
        this.collectFilter('unidad_compradora_filtro[]', query, 'uc');
        this.collectFilter('tipo_contr_filtro[]', query, 'tc');
        this.collectFilter('metodo_contr_filtro[]', query, 'mc');
        this.collectFilter('etapa_proc_filtro[]', query, 'ep');
        this.collectFilter('estatus_contr_filtro[]', query, 'ec');
        const fInicio = document.getElementById('fecha_inicio_filtro').value;
        if (fInicio) {
            query.append('fi', fInicio);
        }
        const fFinal = document.getElementById('fecha_final_filtro').value;
        if (fFinal) {
            query.append('ff', fFinal);
        }
        for(let i = 1; i <= 4; i++) {
            if (document.getElementById(`fecha_trimestre${i}_filtro`).value === '1') {
                query.append('tr', i.toString());
                break;
            }
        }

        return query;
    },
    queryFiltros() {
        const query = this.searchParams();

        return query.toString();
    },
    collectFilter(inputName, query, name) {
        const inputs = document.getElementsByName(inputName);
        const inputs_checked = [];
        inputs.forEach(i => { 
            if (i.checked) {
                inputs_checked.push(i.value)
            }                    
        });                
        if (inputs_checked.length > 0) {
            query.append(name, inputs_checked.join(','));
        }
    },
    countFiltros() {
        const query = this.searchParams();
        const filtros = query.keys();
        let counter = 0;
        for (const element of filtros) {
            counter++;
        }

        return counter;
    },
}))

Alpine.data('oportunidadNegocioSugeridos', () => ({
    eliminaSugerido(oportunidadId, token) {
        Swal.fire({
            ...SwalMTVCustom,
            title: 'Oportunidades de negocio sugeridas',
            html: '<span>¿Deseas eliminar borrar la oportunidad sugerida para que no aparezca en esta sección?</span>',
        }).then((result) => {
            if (result.isConfirmed) {
                fetch('/notificaciones/sugerencias/delete/' + oportunidadId, {
                    method: "DELETE",
                    credentials: 'same-origin',
                    headers: {
                        'X-CSRF-Token': token,
                    },
                }).then(response => {                    
                    if (response.ok) {
                        location.reload();
                    }
                });                                
            }
        })
    }
}))

// Funciones de filtro, búsqueda y ordenamiento para tablas de datos (p.e. tablas del Calendario de compras y detalle).
Alpine.data('dataTable', () => ({
    // Paginación y ordenamiento
    dataTableSource: null,
    rows: [],
    pages: [],
    view: 10,
    offset: 10,
    pagination: {
        total: 0,
        lastPage: 0,
        perPage: 10,
        currentPage: 1,
        from: 1,
        to: 1 * 10
    },
    currentPage: 1,
    sorted: {
        field: '',
        rule: 'asc'
    },
    // https://fusejs.io/api/options.html
    searchOptions: {
        keys: [],
        includeScore: true,
        ignoreLocation: true,
    },
    search(value) {
        this.searchKeyword = value;
        let filteredRows = [];
        if (value.length > 1) {
            const fuse = new Fuse(this.dataTableSource, this.searchOptions);
            const scores = fuse.search(value);
            scores.forEach(c => {
                if (c.score > 0 && c.score <= 0.6) {
                    filteredRows.push(this.dataTableSource[c.refIndex])
                }
            });
        } else {
            filteredRows = this.dataTableSource;
        }
        this.rows = filteredRows;
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
    changePage(page) {
        if (page >= 1 && page <= this.pagination.lastPage) {
            this.currentPage = page
            const total = this.rows.length
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
    checkView(index) {
        return !(index > this.pagination.to || index < this.pagination.from)
    },
    sort(field, rule) {
        this.items = this.rows.sort(this.sortFunction(field, rule))
        this.sorted.field = field
        this.sorted.rule = rule
    },
    sortFunction(key, rule) {
        return function(a, b) {
            let comparison = 0
            let fieldA
            let fieldB
            if (typeof a[key] === 'number') {
                fieldA = a[key]
                fieldB = b[key]
            } else {
                const fieldADate = DateTime.fromFormat(a[key], 'dd/mm/yyyy')
                if (fieldADate.isValid) {
                    fieldA = fieldADate
                    fieldB = DateTime.fromFormat(b[key], 'dd/mm/yyyy')
                } else {
                    fieldA = (typeof a[key] === 'string') ? a[key].toUpperCase().normalize("NFD").replace(/[\u0300-\u036f]/g, "") : a[key]
                    fieldB = (typeof b[key] === 'string') ? b[key].toUpperCase().normalize("NFD").replace(/[\u0300-\u036f]/g, "") : b[key]
                }
            }
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
    },
    resizePages(startPage = 1) {
        this.currentPage = startPage;
        this.pagination.total = this.rows.length;
        this.pagination.lastPage = Math.ceil(this.rows.length / this.view);
        this.changePage(startPage)
        this.showPages();
    },
    isEmpty() {
        return !this.pagination.total
    }
}))

Alpine.start();

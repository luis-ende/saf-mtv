import './bootstrap';

import '../sass/app.scss';
import * as bootstrap from 'bootstrap';
window.bootstrap = bootstrap;

import swal from 'sweetalert2';
window.Swal = swal;

import Alpine from 'alpinejs';
import mask from '@alpinejs/mask'

Alpine.plugin(mask)

window.Alpine = Alpine;

Alpine.store('filesUploaded', { hasFilesUploaded: false });

Alpine.start();

// var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
// var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
//     return new bootstrap.Popover(popoverTriggerEl)
// })

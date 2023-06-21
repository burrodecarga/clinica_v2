import './bootstrap';

import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';
import Swal from 'sweetalert2/dist/sweetalert2.all.js';

window.Alpine = Alpine;
window.Swal = Swal;

Alpine.plugin(focus);

Alpine.start();

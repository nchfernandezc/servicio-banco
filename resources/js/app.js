import './bootstrap';

import Alpine from 'alpinejs';

import 'simple-datatables/dist/style.css';
import 'toastr/build/toastr.min.css';
import toastr from 'toastr';
import Swal from 'sweetalert2';

window.toastr = toastr;
window.Swal = Swal;
window.Alpine = Alpine;

Alpine.start();

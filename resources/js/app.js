import toastr from 'toastr';
import './bootstrap';
import 'toastr/build/toastr.min.css';

window.toastr = toastr;

toastr.options = {
    "positionClass": "toast-bottom-full-width",
    "closeButton": false,
    "progressBar": true,
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
};

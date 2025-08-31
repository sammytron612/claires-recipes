require('./bootstrap');

import Alpine from 'alpinejs';

// Start Alpine
window.Alpine = Alpine;
Alpine.start();

import 'select2';

import Swal from 'sweetalert2';


window.Swal = Swal;

const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  onOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})

Livewire.on('toast', message => {
    Toast.fire(message.text,'', message.type);

})

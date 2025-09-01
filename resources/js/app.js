require('./bootstrap');

// Alpine is automatically loaded by Livewire v3, no need to import it separately

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

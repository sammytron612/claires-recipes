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
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})

window.Toast = Toast;

Livewire.on('toast', (event) => {
    console.log('Toast event received:', event);
    
    // Handle both array format and direct object format
    let data = event;
    if (Array.isArray(event) && event.length > 0) {
        data = event[0];
    }
    
    Toast.fire({
        text: data.text || 'Notification',
        icon: data.type || 'info'
    });
})

// Test function to verify SweetAlert is working
window.testSweetAlert = function() {
    Swal.fire('Test', 'SweetAlert is working!', 'success');
};

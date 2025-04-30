import axios from 'axios';
import Swal from "sweetalert2/dist/sweetalert2";

axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

axios.interceptors.response.use(function (response) {
    return response;
}, function (error) {
    let errMsg = 'Error desconocido';
    switch(error.response.status){
      case 401:
        errMsg = 'Tu sesión ha expirado, por favor inicia sesión nuevamente';
        setTimeout(() => {
          window.location.href = '/logout';
        }, 2000);
        break;
      case 400:
      case 409:
        errMsg = error.response.data.message ?? 'Hubo un problema al realizar la acción. Existe un conflicto con el proceso que quieres realizar';
        break;
      case 422:
        errMsg = error.response.data.message ?? 'Hubo un problema al procesar la solicitud, intente nuevamente o contactese con soporte técnico';
        break;
      case 500:
        errMsg = error.response.data.message ?? 'Hubo un error inesperado. Contactese con soporte técnico';
        break;
      case 404:
        errMsg = 'La información que busca no existe o fue eliminado';
        break;
    }
    Swal.fire({
      title: 'Error',
      text: errMsg,
      icon: 'error',
      confirmButtonText: 'Aceptar',
    });
       
    return Promise.reject(error);
});

export default axios;
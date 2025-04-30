import axios from '@/utils/axios';

export default {
    get: (params) => axios.get('/ficha-vehicular/listar', { params }).then(res=>res.data),
    create: (data) => axios.post('/ficha-vehicular', data).then(res=>res.data),
    update: (id, data) => axios.put(`/ficha-vehicular/${id}`, data).then(res=>res.data),
    updatePoliza: (id, data) => axios.patch(`/ficha-vehicular/${id}/poliza`, data).then(res=>res.data),
};
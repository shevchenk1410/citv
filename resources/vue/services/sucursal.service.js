import axios from '@/utils/axios';

export default {
    get: (params) => axios.get('/sucursales/listar', { params }).then(res=>res.data),
    create: (data) => axios.post('/sucursales', data).then(res=>res.data),
    update: (id, data) => axios.put(`/sucursales/${id}`, data).then(res=>res.data),
    updateState: (id) => axios.patch(`/sucursales/${id}`).then(res=>res.data),
};
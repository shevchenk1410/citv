import axios from '@/utils/axios';

export default {
    get: (params) => axios.get('/operaciones-diarias/listar', { params }).then(res=>res.data),
    create: (data) => axios.post('/operaciones-diarias', data).then(res=>res.data),
    update: (id, data) => axios.put(`/operaciones-diarias/${id}`, data).then(res=>res.data),
    updateState: (id) => axios.patch(`/operaciones-diarias/${id}`).then(res=>res.data),
};
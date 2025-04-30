import axios from '@/utils/axios';

export default {
    get: (params) => axios.get('/usuarios/listar', { params }).then(res=>res.data),
    create: (data) => axios.post('/usuarios', data).then(res=>res.data),
    update: (id, data) => axios.put(`/usuarios/${id}`, data).then(res=>res.data),
    updateState: (id) => axios.patch(`/usuarios/${id}`).then(res=>res.data),
};
import axios from '@/utils/axios';

export default {
    get: (params) => axios.get('/roles/listar', { params }).then(res=>res.data),
    create: (data) => axios.post('/roles', data).then(res=>res.data),
    update: (id, data) => axios.put(`/roles/${id}`, data).then(res=>res.data),
    updateMenu: (id, data) => axios.put(`/roles/${id}/menu`, data).then(res=>res.data),
    updateState: (id, data) => axios.patch(`/roles/${id}`, data).then(res=>res.data),
};
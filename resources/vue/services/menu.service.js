import axios from '@/utils/axios';

export default {
    get: (params) => axios.get('/menus/listar', { params }).then(res=>res.data),
    create: (data) => axios.post('/menus', data).then(res=>res.data),
    update: (id, data) => axios.put(`/menus/${id}`, data).then(res=>res.data),
    updateState: (id, data) => axios.patch(`/menus/${id}`, data).then(res=>res.data),
};
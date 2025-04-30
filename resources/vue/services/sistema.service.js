import axios from '@/utils/axios';

export default {
    get: (params) => axios.get('/sistema', { params }).then(res=>res.data),
};
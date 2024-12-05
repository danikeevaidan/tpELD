import axios from '../plugins/axios.js';
import store from '../store/index.js';

const apiClient = axios.create({
    withCredentials: true,
    headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json',
    }
});
export default {
    async logout(token) {
        return apiClient.post('/api/logout', {}, {
            headers: {Authorization: `Bearer ${token}`}
        });
    },

    async getUser() {
        return apiClient.get('/api/me');
    }
};

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
    async register(user) {
        return apiClient.post('/api/register', user);
    },

    async login(credentials) {
        return apiClient.post('/api/login', credentials);
    },

    async logout(token) {
        return apiClient.post('/api/logout', {}, {
            headers: {Authorization: `Bearer ${token}`}
        });
    },

    async getUser() {
        return apiClient.get('/api/me');
    }
};
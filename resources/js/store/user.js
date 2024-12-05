import authService from "../services/authService.js";
import axios from '../plugins/axios.js';

export default {
    namespaced: true,
    state: () => ({
        user: null,
        status: null,
        notifications: [],
    }),
    mutations: {
        SET_USER(state, data) {
            state.user = data.user;
            state.notifications = data.notifications.sort((a,b)=> {
                return Math.abs(new Date(a.created_at.replace(/-/g,'/')) - new Date(b.created_at.replace(/-/g,'/')));
            });
        },
        LOGOUT(state) {
            state.user = null;
            state.notifications = [];
        },
        MARK_AS_READ(state, index) {
            state.notifications[index].read_at = new Date();
        },
        ADD_NOTIFICATION(state, notification) {
            state.notifications.unshift(notification);
        }
    },
    actions: {
        async login({ commit }, credentials) {
            const response = await axios.post('/api/login', credentials);
            localStorage.setItem('token', response.data.access_token)
            commit('SET_USER', response.data.user);
            return response.data;
        },
        async register({ commit }, credentials) {
            const response = await axios.post('/api/register', credentials);
            return response.data;
        },
        async fetchUser({ commit }) {
            const response = await authService.getUser();
            commit('SET_USER', response.data);
            return response.data;
        },
        async logout({ commit, state }) {
            const response = await axios.post('/api/logout')
            commit('LOGOUT');
            return response;
        },
        markAsRead({commit}, index) {
            commit('MARK_AS_READ', index);
        },
        addNotification({commit}, notification) {
            commit('ADD_NOTIFICATION', notification);
        }
    },
    getters: {
        user(state){
            return state.user;
        },
        notifications(state) {
            return state.notifications;
        }
    }
}

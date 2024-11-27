import authService from "../services/authService.js";

export default {
    namespaced: true,
    state: () => ({
        user: null,
        token: null,
        status: null,
        admin: null,
        notifications: [],
    }),
    mutations: {
        SET_TOKEN(state, token) {
            state.token = token;
        },
        SET_USER(state, user) {
            state.user = user;
        },
        logout(state) {
            state.admin = false;
            state.user = null;
            state.token = null;
            state.notifications = [];
        },
        SET_NOTIFICATIONS(state, notifications) {
            state.notifications = notifications.sort((a,b)=> {
                return Math.abs(new Date(a.created_at.replace(/-/g,'/')) - new Date(b.created_at.replace(/-/g,'/')));
            });
            console.log(state.notifications);
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
            const response = await authService.login(credentials);
            commit('SET_TOKEN', response.data.access_token)
            commit('SET_USER', response.data.user);
            commit('SET_NOTIFICATIONS', response.data.user.notifications);
            return response.data;
        },
        async register({ commit }, credentials) {
            const response = await authService.register(credentials);
            return response.data;
        },
        async fetchUser({ commit }) {
            const response = await authService.getUser();
            commit('SET_USER', response.data);
            return response.data;
        },
        logout({ commit, state }) {
            const response = authService.logout(state.token);
            commit('logout');
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
        admin(state) {
            return state.admin;
        },
        notifications(state) {
            return state.notifications;
        },
        token(state) {
            return state.token;
        }
    }
}

import authService from "../services/authService.js";

export default {
    namespaced: true,
    state: () => ({
        user: false,
        driver: null,
        status: null,
        admin: false,
        token: localStorage.getItem("token") || null,
        notifications: []
    }),
    mutations: {
        setToken(state, token) {
            state.token = token;
        },
        setUser(state, user) {
            state.user = user;
        },
        setDriver(state, driver) {
            state.driver = driver;
        },
        setAdmin(state, admin) {
            state.admin = admin;
        },
        logout(state) {
            state.admin = false;
            state.token = null;
            state.user = null;
            state.notifications = [];
        },
        setNotifications(state, notifications) {
            state.notifications = notifications;
        },
        markAsRead(state, index) {
            state.notifications[index].isRead = true;
        }
    },
    actions: {
        async login({ commit }, credentials) {
            const response = await authService.login(credentials);
            console.log(response);
            commit('setToken', response.data.access_token);
            commit('setUser', response.data.user);
            commit('setDriver', response.data.user.driver);
            commit('setNotifications', response.data.user.notifications)
            return response.data;
        },
        async register({ commit }, credentials) {
            const response = await authService.register(credentials);
            commit('setToken', response.data.access_token);
            return response.data;
        },
        async fetchUser({ commit }) {
            const response = await authService.getUser();
            commit('setUser', response.data);
            return response.data;
        },
        logout({ commit, state }) {
            console.log("TOKEN", state.token);
            const response = authService.logout(state.token);
            commit('logout');
            return response;
        },
        markAsRead({commit}, index) {
            commit('markAsRead', index);
        }
    },
    getters: {
        user(state){
            return state.user;
        },
        admin(state) {
            return state.admin;
        },
        token(state) {
            return state.token;
        },
        driver(state) {
            return state.driver;
        },
        notifications(state) {
            return state.notifications;
        }
    }
}

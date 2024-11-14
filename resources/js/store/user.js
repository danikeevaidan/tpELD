import authService from "../services/authService.js";

export default {
    namespaced: true,
    state: () => ({
        user: false,
        driver: false,
        admin: false,
        token: localStorage.getItem("token") || null,
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
        }
    },
    actions: {
        async login({ commit }, credentials) {
            const response = await authService.login(credentials);
            commit('setToken', response.data.access_token);
            commit('setUser', response.data.user);
            console.log("DRIVER FROM RESPONSE", response.data.user);
            commit('setDriver', response.data.user.driver);
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
        logout({ commit }) {
            const response = authService.logout();
            commit('logout');
            return response;
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
        }
    }
}

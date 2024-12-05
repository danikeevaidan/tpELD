import { createStore } from 'vuex';
import user from './user.js';

export default createStore({
    modules: {
        user
    }
})



// const store = createStore({
//     state: {
//         user: null,
//         role: '',
//         drivers: [],
//         reports: [],
//         gpsData: [],
//         isLoading: false,
//     },
//     mutations: {
//         SET_USER(state, user) {
//             state.user = user;
//         },
//         SET_ROLE(state, role) {
//             state.role = role;
//         },
//         SET_DRIVERS(state, drivers) {
//             state.drivers = drivers;
//         },
//         SET_REPORTS(state, reports) {
//             state.reports = reports;
//         },
//         SET_GPS_DATA(state, gpsData) {
//             state.gpsData = gpsData;
//         },
//         SET_LOADING(state, isLoading) {
//             state.isLoading = isLoading;
//         },
//     },
//     actions: {
//         async fetchUser({ commit }) {
//             commit('SET_LOADING', true);
//             try {
//                 const response = await axios.get('/api/user');
//                 commit('SET_USER', response.data);
//                 commit('SET_ROLE', response.data.role);
//             } catch (error) {
//                 console.error(error);
//             } finally {
//                 commit('SET_LOADING', false);
//             }
//         },
//         async fetchDrivers({ commit }) {
//             commit('SET_LOADING', true);
//             try {
//                 const response = await axios.get('/api/drivers');
//                 commit('SET_DRIVERS', response.data);
//             } catch (error) {
//                 console.error(error);
//             } finally {
//                 commit('SET_LOADING', false);
//             }
//         },
//         async fetchReports({ commit }) {
//             commit('SET_LOADING', true);
//             try {
//                 const response = await axios.get('/api/reports');
//                 commit('SET_REPORTS', response.data);
//             } catch (error) {
//                 console.error(error);
//             } finally {
//                 commit('SET_LOADING', false);
//             }
//         },
//         async fetchGPSData({ commit }) {
//             commit('SET_LOADING', true);
//             try {
//                 const response = await axios.get('/api/gps-data');
//                 commit('SET_GPS_DATA', response.data);
//             } catch (error) {
//                 console.error(error);
//             } finally {
//                 commit('SET_LOADING', false);
//             }
//         },
//     },
//     getters: {
//         isAdmin: (state) => state.role === 'admin',
//         isSuperAdmin: (state) => state.role === 'superadmin',
//         isDispatcher: (state) => state.role === 'dispatcher',
//         isDriver: (state) => state.role === 'driver',
//         isDeveloper: (state) => state.role === 'developer',
//         getUser: (state) => state.user,
//         getDrivers: (state) => state.drivers,
//         getReports: (state) => state.reports,
//         getGPSData: (state) => state.gpsData,
//     },
// });
//
// export default store;

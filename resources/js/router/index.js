import { createRouter, createWebHistory } from 'vue-router';
import DriverList from '../pages/DriverList.vue';
import DriverProfile from "../pages/DriverProfile.vue";

const routes = [
    {
        name: 'DriverList',
        path: '/',
        component: DriverList
    },
    {
        name: 'DriverProfile',
        path: '/drivers/:id',
        component: DriverProfile
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;

import { createRouter, createWebHistory } from 'vue-router';
import Home from '../pages/Home.vue';
import DriverProfile from "../pages/DriverProfile.vue";
import Register from '../pages/Register.vue';
import Login from '../pages/Login.vue';
import About from '../pages/About.vue';

const routes = [
    {
        name: 'Home',
        path: '/',
        component: Home
    },
    {
        name: 'DriverProfile',
        path: '/profile',
        component: DriverProfile
    },
    {
        name: 'Register',
        path: '/register',
        component: Register
    },
    {
        name: 'Login',
        path: '/login',
        component: Login
    },
    {
        name: 'About',
        path: '/about',
        component: About
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;

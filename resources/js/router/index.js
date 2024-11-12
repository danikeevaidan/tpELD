import ExampleComponent from "../components/ExampleComponent.vue";
import { createRouter, createWebHistory } from 'vue-router';

const routes = [
    {
        name: 'example',
        path: '/',
        component: ExampleComponent
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;

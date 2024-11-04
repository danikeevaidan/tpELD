import { createRouter, createWebHistory } from 'vue-router';

import Login from './components/Login.vue';
import DashboardAdmin from './components/admin/DashboardAdmin.vue';
import DashboardDriver from './components/driver/DashboardDriver.vue';
import Users from './components/admin/Users.vue';
import UserCreate from './components/admin/UserCreate.vue';
import UserEdit from './components/admin/UserEdit.vue';
import Drivers from './components/dispatcher/Drivers.vue';
import DriverDetails from './components/dispatcher/DriverDetails.vue';
import Reports from './components/Reports.vue';
import ReportCreate from './components/ReportCreate.vue';
import GPS from './components/GPS.vue';

const routes = [
    { path: '/login', name: 'Login', component: Login },

    // Dashboard routes for different roles
    { path: '/dashboard', name: 'DashboardAdmin', component: DashboardAdmin, meta: { requiresAuth: true, role: 'admin' } },
    { path: '/dashboard/driver', name: 'DashboardDriver', component: DashboardDriver, meta: { requiresAuth: true, role: 'driver' } },

    // Users management (for admin and superadmin)
    { path: '/users', name: 'Users', component: Users, meta: { requiresAuth: true, role: 'superadmin' } },
    { path: '/users/create', name: 'UserCreate', component: UserCreate, meta: { requiresAuth: true, role: 'superadmin' } },
    { path: '/users/:id/edit', name: 'UserEdit', component: UserEdit, meta: { requiresAuth: true, role: 'superadmin' } },

    // Driver routes (for dispatcher)
    { path: '/drivers', name: 'Drivers', component: Drivers, meta: { requiresAuth: true, role: 'dispatcher' } },
    { path: '/drivers/:id', name: 'DriverDetails', component: DriverDetails, meta: { requiresAuth: true, role: 'dispatcher' } },

    // Reports routes
    { path: '/reports', name: 'Reports', component: Reports, meta: { requiresAuth: true, role: 'admin' } },
    { path: '/reports/create', name: 'ReportCreate', component: ReportCreate, meta: { requiresAuth: true, role: 'admin' } },

    // GPS tracking
    { path: '/gps', name: 'GPS', component: GPS, meta: { requiresAuth: true, role: 'dispatcher' } },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

// Route guard to check authentication and role access
router.beforeEach((to, from, next) => {
    const isAuthenticated = !!store.state.user;
    const userRole = store.state.role;

    if (to.meta.requiresAuth && !isAuthenticated) {
        next({ name: 'Login' });
    } else if (to.meta.role && to.meta.role !== userRole) {
        next({ name: 'Dashboard' });
    } else {
        next();
    }
});

export default router;

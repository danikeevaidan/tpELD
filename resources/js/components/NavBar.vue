<script>
import store from '../store/index.js';
import router from '../router/index.js';
export default {
    data() {
        return {
            user: false,
            isAuthenticated: false,
        }
    },
    beforeMount() {

    },
    mounted() {
        this.getUser();

    },
    methods: {
        getUser() {
            let user = store.getters['user/user'];
            this.user = user;
            this.isAuthenticated = Boolean(user);
        },
        async logout() {
            this.isAuthenticated = false;
            await store.dispatch('user/logout');
            router.push('/');
        },
    },
};
</script>


<template>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <!-- Brand Logo -->
            <a class="navbar-brand" href="/">ELD Website</a>

            <!-- Toggle button for mobile view -->
            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav"
                aria-controls="navbarNav"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Home</a>
                    </li>

                    <li v-if="isAuthenticated" class="nav-item">
                        <a class="nav-link" href="/eld-simulator">ELD Simulator</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/about">About</a>
                    </li>

                    <li v-if="isAuthenticated" class="nav-item dropdown">
                        <a
                            class="nav-link dropdown-toggle"
                            href="#"
                            id="profileDropdown"
                            role="button"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                        >
                            {{ user.name }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="profileDropdown">
                            <li><a class="dropdown-item" href="/profile">Profile</a></li>
                            <li><a class="dropdown-item" href="/settings">Settings</a></li>
                            <li><hr class="dropdown-divider" /></li>
                            <li><a class="dropdown-item" @click="logout()">Logout</a></li>
                        </ul>
                    </li>

                    <li v-if="!isAuthenticated" class="nav-item">
                        <a class="nav-link" href="/login">Login</a>
                    </li>
                    <li v-if="!isAuthenticated" class="nav-item">
                        <a class="nav-link" href="/register">Register</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<style scoped>
    .navbar-brand {
        font-weight: bold;
    }
</style>

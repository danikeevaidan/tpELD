<script setup>

import { ref, onMounted, computed } from 'vue';
import store from '../store/index.js';
import router from '../router/index.js';
import _axios from '../plugins/axios.js';

const user = computed(() => store.getters['user/user']);
const isAuthenticated = computed(() => Boolean(user.value));
const notifications = computed(() => store.getters['user/notifications']);
const unread = computed(() => notifications.value?.filter(value => value.read_at == null));

const logout = async () => {
    await store.dispatch('user/logout');
    router.push('/');
};

const markAsRead = async (index) => {
    const notification = notifications.value[index];
    if (!notification.read_at) {
        try {
            const response = await _axios.put('/api/read-notification', { id: notification.id });
            await store.dispatch('user/markAsRead', index);
        } catch (error) {
            console.error('Error marking notification as read:', error);
        }
    }
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

                    <li v-if="isAuthenticated" class="nav-item">
                        <a class="nav-link" href="/drivers">Drivers</a>
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

                    <li v-if="isAuthenticated">
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item dropdown">
                                <a
                                    class="nav-link dropdown-toggle"
                                    href="#"
                                    id="notificationDropdown"
                                    role="button"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false"
                                >
                                    Notifications <span class="badge bg-success" v-if="unread.length>0">{{ unread.length }}</span>
                                </a>
                                <ul
                                    class="dropdown-menu dropdown-menu-end overflow-x-hidden overflow-y-scroll"
                                    style="width: 25rem; height: 25rem"
                                    aria-labelledby="notificationDropdown"
                                >
                                    <li v-if="notifications.length === 0">
                                        <span class="dropdown-item-text text-muted">No notifications</span>
                                    </li>
                                    <li v-for="(notification, index) in notifications" :key="index">
                                        <a
                                            href="#"
                                            class="dropdown-item"
                                            @click.prevent="markAsRead(index)"
                                            v-bind:class='!(notification.read_at==null)?"":"bg-success-subtle text-success-emphasis"'
                                        >
                                            <p class="m-0 fw-bold">{{ notification.message }}</p>
                                            <span class="fs-6 text-muted">{{ notification.created_at}}</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>

                    <li v-if="!isAuthenticated" class="nav-item">
                        <a class="nav-link" href="/login">Login</a>
                    </li>
                    <li v-if="!isAuthenticated" class="nav-item">
                        <a class="nav-link" href="/register">Register</a>
                    </li>
                </ul>

<!--                <div class="collapse navbar-collapse" id="navbarNav">-->
<!--                </div>-->
            </div>
        </div>
    </nav>
</template>

<style scoped>
    .navbar-brand {
        font-weight: bold;
    }
</style>

<script setup>
    import NavBar from "./components/NavBar.vue";
    import Pusher from 'pusher-js';
    import {useToast} from 'vue-toast-notification';
    import store from './store/index.js';
    import {computed, onMounted} from "vue";
    import axios from './plugins/axios.js';

    const user = computed(() => store.getters['user/user'])
    onMounted(() => {
        if (localStorage.getItem('token')) {
            axios.get('/api/user')
                .then(response => {
                    store.commit('user/SET_USER', response.data)
                })
        }
    })

    try {
        let pusher = new Pusher("bf8f8bde31898db6f80b", {
            cluster: "eu",
        });

        let channel = pusher.subscribe("driver-notification-channel-" + user.value?.id);
        channel.bind("driver-status-changed", (data) => {
            console.log('NEW NOTIFICATION', data);
            store.dispatch('user/addNotification', data)
            displayToastNotification(data);
        });
    } catch(e) {
        console.log(e);
    }

    let displayToastNotification = (data) => {
        const $toast = useToast();
        $toast.default(data.message, {
            type: data.message_type,
            position:'top',
            queue: true
        });
    }
</script>

<template>
    <div>
        <NavBar/>
        <div class="container">
            <router-view v-slot="{ Component, route }">
                <div :key="route.name">
                    <Component :is="Component"/>
                </div>
            </router-view>
        </div>
    </div>

</template>

<style scoped>

</style>

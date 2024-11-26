<script setup>
    import NavBar from "./components/NavBar.vue";
    import Echo from 'laravel-echo';
    import Pusher from 'pusher-js';
    import {useToast} from 'vue-toast-notification';
    import store from './store/index.js';

    let pusher = new Pusher("bf8f8bde31898db6f80b", {
        cluster: "eu",
    });

    let channel = pusher.subscribe("driver-notification-channel-" + store.getters['user/driver'].id);
    channel.bind("driver-status-changed", (data) => {
        displayToastNotification(data);
    });

    let displayToastNotification = (data) => {
        const $toast = useToast();
        let instance = $toast.default(data.message, {
            type: data.message_type,
            position:'top',
            queue: true
        });
    }

    let notifications = store.getters['user/notifications'].filter((value) => {
        return value.isRead === 0;
    });

    for(let i in notifications) {
        displayToastNotification(notifications[i]);
    }



    // Pusher.logToConsole = true;
    //
    // const messages = [];
    //
    // let pusher = new Pusher('bf8f8bde31898db6f80b', {
    //     cluster: 'eu'
    // });
    //
    // let channel = pusher.subscribe('my-channel');
    // channel.bind('driver-status-changed', (data) => {
    //     // messages.push(JSON.stringify(data));
    //     console.log("DATA", data);
    // });
    //
    // // channel.emit('driver-status-changed');
    // console.log("MESSAGES", messages);

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

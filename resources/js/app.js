/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import router from './router/index.js';
import { createApp } from 'vue';
import VueGoogleMaps from '@fawmi/vue-google-maps';
import App from './App.vue';
import store from './store';
import MapComponent from './components/MapComponent.vue';
import CanvasJSChart from '@canvasjs/vue-charts';
import * as vue from './components/App.vue';
import ToastPlugin from 'vue-toast-notification';
// Import one of the available themes
//import 'vue-toast-notification/dist/theme-default.css';
import 'vue-toast-notification/dist/theme-bootstrap.css';
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';
import * as PusherPushNotifications from "@pusher/push-notifications-web";

const beamsClient = new PusherPushNotifications.Client({
    instanceId: "<YOUR_INSTANCE_ID_HERE>",
});

beamsClient.start().then(() => {

});

const app = createApp(App);
app.use(store);
app.use(router);
app.use(ToastPlugin);
app.use(CanvasJSChart);

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    forceTLS: true,
});

if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('/service-worker.js')
        .then(function (registration) {
            console.log('Service Worker зарегистрирован:', registration);
        })
        .catch(function (error) {
            console.error('Ошибка регистрации Service Worker:', error);
        });
}


app.use(VueGoogleMaps, {
    load: {
        key: '', //TODO: add API key in here
        libraries: 'places',
    },
});
app.component('map-component', MapComponent);


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// Object.entries(import.meta.glob('./**/*.vue', { eager: true })).forEach(([path, definition]) => {
//     app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
// });

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */

app.mount('#app');

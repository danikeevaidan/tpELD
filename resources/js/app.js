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


const app = createApp(App);
app.use(store);
app.use(router);
app.use(CanvasJSChart);

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

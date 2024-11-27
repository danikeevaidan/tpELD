<script setup>
import store from '../store/index.js';
import router from "../router/index.js";
import {ref} from "vue";

const email = ref('');
const password = ref('');
const loginError = ref('');

const login = async () => {
    try {
        await store.dispatch('user/login', {
            email: email.value,
            password: password.value,
        });
        router.push('/');
    } catch (error) {
        if (error.response && (error.response.status === 422 || error.response.status === 401)) {
            console.log(error);
            loginError.value = error.response.data.message;
        }

    }
};


</script>

<template>
    <h2 class="text-center">Login</h2>
    <div class="container d-flex justify-content-around">
        <form @submit.prevent="login" class="w-50">
            <input v-model="email" type="email" placeholder="Email" class="form-control mb-3">
            <input v-model="password" type="password" placeholder="Password" class="form-control mb-3">
            <p v-if="loginError" class="error">{{loginError}}</p>
            <button class="btn btn-primary" type="submit">Login</button>
        </form>
    </div>
</template>

<style scoped>
.error {
    color: red;
}

.success {
    color: green;
}
</style>

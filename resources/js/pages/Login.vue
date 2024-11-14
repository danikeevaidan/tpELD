<script>
import store from '../store/index.js';
import router from "../router/index.js";
export default {
    data: function() {
        return {
            email: '',
            password: ''
        }
    },
    methods: {
        async login() {
            await store.dispatch('user/login', {
                'email': this.email,
                'password': this.password
            });

            router.push('/');
        }
    }
}


</script>

<template>
    <h2 class="text-center">Login</h2>
    <div class="container d-flex justify-content-around">
        <form @submit.prevent="login" class="w-50">
            <input v-model="email" type="email" placeholder="Email" class="form-control mb-3">
            <input v-model="password" type="password" placeholder="Password" class="form-control mb-3">
            <button class="btn btn-primary" type="submit">Login</button>
        </form>
    </div>
</template>

<style scoped>

</style>

<script>
import authService from '../services/authService';
import router from "../router/index.js";
import store from "@/store/index.js";
export default {
    data() {
        return {
            name: '',
            email: '',
            password: '',
            password_confirmation: ''
        };
    },
    methods: {
        async register() {
            try {
                const response = await this.$store.dispatch('user/register', {
                    name: this.name,
                    email: this.email,
                    password: this.password,
                    password_confirmation: this.password_confirmation
                });

                await store.dispatch('user/login', {
                    'email': this.email,
                    'password': this.password
                });

                router.push('/');
            } catch (error) {
                console.error('Registration error:', error);
            }
        }
    }
};
</script>

<template>
    <h2 class="text-center">Register</h2>
    <div class="container d-flex justify-content-around">
        <form @submit.prevent="register" class="w-50">
            <input v-model="name" type="text" placeholder="Name" class="form-control mb-3">
            <input v-model="email" type="email" placeholder="Email" class="form-control mb-3">
            <input v-model="password" type="password" placeholder="Password" class="form-control mb-3">
            <input v-model="password_confirmation" type="password" placeholder="Confirm Password" class="form-control mb-3">
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
    </div>
</template>

<style scoped>

</style>

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
            password_confirmation: '',
            registerErrors: {},
            registerSuccessMessage: ''
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

                this.successMessage = response.data.message;
                this.errors = {};

                await store.dispatch('user/login', {
                    'email': this.email,
                    'password': this.password
                });

                router.push('/');
            } catch (error) {
                if (error.response && error.response.status === 401) {
                    this.registerErrors = error.response.data.errors;
                    this.registerSuccessMessage = '';
                }
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
            <span v-if="registerErrors.email" class="error">{{ registerErrors.email[0] }}</span>
            <input v-model="password" type="password" placeholder="Password" class="form-control mb-3">
            <span v-if="registerErrors.password" class="error">{{ registerErrors.password[0] }}</span>
            <input v-model="password_confirmation" type="password" placeholder="Confirm Password" class="form-control mb-3">
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
        <p v-if="registerSuccessMessage" class="success">{{ registerSuccessMessage }}</p>
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

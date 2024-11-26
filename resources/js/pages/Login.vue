<script>
import store from '../store/index.js';
import router from "../router/index.js";
export default {
    data: function() {
        return {
            email: '',
            password: '',
            loginErrors: {},
            loginSuccessMessage: ''
        }
    },
    methods: {
        async login() {
            try{
                let data = await store.dispatch('user/login', {
                    'email': this.email,
                    'password': this.password
                });

                this.loginSuccessMessage = data.message;
                this.loginErrors = {};

                router.push('/');
            }catch (error){
                console.log(error);
                if (error.response && error.response.status === 422 || error.response.status === 401) {
                    this.loginErrors = error.response.data.errors;
                    this.loginSuccessMessage = '';
                }
            }
        },
    }
}


</script>

<template>
    <h2 class="text-center">Login</h2>
    <div class="container d-flex justify-content-around">
        <form @submit.prevent="login" class="w-50">
            <input v-model="email" type="email" placeholder="Email" class="form-control mb-3">
            <span v-if="loginErrors.email" class="error">{{ loginErrors.email[0] }}</span>
            <input v-model="password" type="password" placeholder="Password" class="form-control mb-3">
            <span v-if="loginErrors.password" class="error">{{ loginErrors.password[0] }}</span>
            <button class="btn btn-primary" type="submit">Login</button>
        </form>
        <p v-if="loginSuccessMessage" class="success">{{ loginSuccessMessage }}</p>
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

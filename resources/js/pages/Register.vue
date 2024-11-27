<script setup>
import { ref } from "vue";
import { useStore } from "vuex";
import { useRouter } from "vue-router";


const store = useStore();
const router = useRouter();

const name = ref("");
const email = ref("");
const password = ref("");
const password_confirmation = ref("");
const registerErrors = ref({});
const registerSuccessMessage = ref("");

const register = async () => {
    try {
        const response = await store.dispatch("user/register", {
            name: name.value,
            email: email.value,
            password: password.value,
            password_confirmation: password_confirmation.value,
        });

        registerSuccessMessage.value = response.data;
        registerErrors.value = {};

        await store.dispatch("user/login", {
            email: email.value,
            password: password.value,
        });

        router.push("/");
    } catch (error) {
        if (error.response?.status === 401) {
            registerErrors.value = error.response.data.errors || {};
            registerSuccessMessage.value = "";
        }
        console.error("Registration error:", error);
    }
};

</script>

<template>
    <h2 class="text-center">Register</h2>
    <div class="container d-flex justify-content-around">
        <form @submit.prevent="register" class="w-50">
            <input v-model="name" type="text" placeholder="Name" class="form-control mb-3">
            <input v-model="email" type="email" placeholder="Email" class="form-control mb-3">
<!--            <span v-if="registerErrors.email" class="error">{{ registerErrors.email[0] }}</span>-->
            <input v-model="password" type="password" placeholder="Password" class="form-control mb-3">
<!--            <span v-if="registerErrors.password" class="error">{{ registerErrors.password[0] }}</span>-->
            <input v-model="password_confirmation" type="password" placeholder="Confirm Password"
                   class="form-control mb-3">
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
<!--        <p v-if="registerSuccessMessage" class="success">{{ registerSuccessMessage }}</p>-->
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

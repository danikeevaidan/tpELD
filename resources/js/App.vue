<script setup>
    import NavBar from "./components/NavBar.vue";
</script>

<template>
    <div>
        <NavBar :isAuthenticated="isUserLoggedIn" :userName="userName" @logout="handleLogout" />
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

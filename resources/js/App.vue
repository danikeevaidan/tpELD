<script setup>

</script>

<template>
    <div class="container">
        <router-view v-slot="{ Component, route }">
            <div :key="route.name">
                <Component :is="Component"/>
            </div>
        </router-view>
    </div>
</template>

<style scoped>

</style>

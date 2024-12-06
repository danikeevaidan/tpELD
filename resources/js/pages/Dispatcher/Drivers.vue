<script setup>
import {onMounted, ref} from "vue";
    import axios from '../../plugins/axios.js';


    const drivers = ref([]);

    onMounted(() => {
        axios.get('/api/drivers')
            .then(response => {
                drivers.value = response.data
            })
            .catch(error => {
                console.log(error);
            })
    })
</script>

<template>
    <table class="table">
        <tr>
            <th>Name</th>
            <th>Email</th>
        </tr>
        <tr v-for="driver in drivers">
            <td>
                <router-link :to="{name: 'DriverShow', params: {id: driver.id}}">
                    {{driver?.user?.name}}
                </router-link>

            </td>
            <td>
                {{driver?.user?.email}}
            </td>
        </tr>
    </table>
</template>

<style scoped>

</style>

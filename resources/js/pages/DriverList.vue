<script >
  import axios from "axios";

  export default {
    data: function () {
      return {
        drivers: []
      }
    },
    mounted() {
      this.getDrivers();
    },
    methods: {
      getDrivers() {
        axios.get('/api/drivers')
            .then(res => {
              this.drivers = res.data;
            })
      }
    }
  }

</script>

<template>
  <h1>Drivers</h1>
  <table>
    <thead>
      <tr>
        <td>Name</td>
      </tr>
    </thead>
    <tbody>
      <tr v-for="driver in this.drivers">
        <td>
          <router-link :to="{name: 'DriverProfile', params: {id: driver.id}}" class="bg-transparent p-0">
            {{ driver.user.name }}
          </router-link>
        </td>
      </tr>
    </tbody>
  </table>
</template>

<style scoped>

</style>

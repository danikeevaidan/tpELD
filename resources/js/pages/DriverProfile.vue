<script>
    import axios from "axios";
    import {useRoute} from "vue-router";

    export default {
        data: function () {
            return {
                driver: null,
            }
        },
        mounted() {
            const route = useRoute();
            const id = route.params.id;

            this.getDriver(id);
        },
        methods: {
          getDriver(id) {
              axios.get(`/api/drivers/${id}`)
                  .then(res => {
                      this.driver = res.data;
                  })
                  .catch(error => {
                      console.log(error);
                  })
          }
        }
    }
</script>

<template>
    <h1>
        {{ this.driver.user.name }}

    </h1>
</template>

<style scoped>

</style>

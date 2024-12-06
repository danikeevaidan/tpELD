<script setup>
    import axios from '../../plugins/axios.js';
    import {useRoute} from "vue-router";
    import {reactive, ref} from "vue";
    import {getWorkingDays, getChart} from '../../services/chartGenerator.js';

    const router = useRoute();
    const driver = ref(null);
    const schedule_entries = ref([]);
    const working_days = ref([]);
    const charts = ref([]);

    // Period info
    const period = ref({});
    const status = ref('');


    axios.get(`/api/drivers/${router.params.id}`)
        .then(response => {
            driver.value = response.data;
            schedule_entries.value = response.data.schedule_entries;
            working_days.value = getWorkingDays(response.data);
            working_days.value.forEach(day => {
                const chart = getChart(driver, schedule_entries, day);
                chart.options.data[0].click = displayPeriodData;
                charts.value.push(chart);
            })
        })
        .catch(error => console.log(error))

    const displayPeriodData = (e) => {
        if (e.dataPointIndex!==0) {
            console.log(e);
            const point1 = e.dataSeries.dataPoints[e.dataPointIndex - 1];
            const date1 = Date.parse(point1.x);
            const date2 = Date.parse(e.dataPoint.x);
            const diffTime = Math.abs(date2 - date1) / (1000 * 60 * 60);
            period.value.hours = Math.floor(diffTime);
            period.value.minutes = Math.round((diffTime - period.value.hours) * 60);
            status.value = ["", "Driving", "On Duty", "Off Duty", "Resting"][point1.y] || "";
        }

    }
</script>

<template>
    <h1>{{driver?.user?.name}}</h1>
    <p class="text-muted">{{driver?.user?.email}}</p>
    <div class="row">
        <div class="col-6" style="height: 580px; overflow-y: scroll;">
            <template v-for="chart in charts">
                <CanvasJSChart
                    class="mb-5"
                    :options="chart.options"
                    :style="chart.styleOptions"
                />
            </template>
        </div>
        <div class="col-6">
            <p v-if="period">Period in status {{status}}: {{period.hours}} hours, {{period.minutes}} minutes</p>
        </div>
    </div>
    <div>

    </div>

</template>

<style scoped>

</style>

<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import * as CanvasJS from "@canvasjs/charts";
import store from "../store/index.js";

const driver = ref(null);
const daysToDisplay = ref([]);
const schedules = ref([]);
const selectedSchedule = ref(null);

const styleOptions = {
    width: "100%",
    height: "360px",
};

const getDriver = async (id) => {
    try {
        const { data } = await axios.get(`/api/drivers/${id}`);
        driver.value = data;
    } catch (error) {
        console.error("Error fetching driver data:", error);
    }
};

const getWorkingDays = () => {
    if (driver.value?.schedule_entries) {
        daysToDisplay.value = [
            ...new Set(
                driver.value.schedule_entries.map((entry) =>
                    new Date(entry.log_time).toDateString()
                )
            ),
        ];
    }
};

const getDriverSchedule = (day) => {
    if (!driver.value?.schedule_entries) return;

    const entries = driver.value.schedule_entries
        .filter((entry) => new Date(entry.log_time).toDateString() === day)
        .sort((a, b) => new Date(a.log_time) - new Date(b.log_time)); // Sorting entries by log time

    schedules.value.push({
        day,
        options: {
            theme: "light2",
            animationEnabled: true,
            exportEnabled: true,
            zoomEnabled: true,
            exportFileName: `Driver ${driver.value.user?.name} ${day}`,
            title: { text: "" },
            axisX: {
                title: "Time",
                labelFormatter: (e) =>
                    new Intl.DateTimeFormat("en", {
                        hour: "2-digit",
                        minute: "2-digit",
                    }).format(e.value),
                interval: 2,
            },
            axisY: {
                title: "Status",
                labelFormatter: (e) =>
                    ["", "Driving", "On Duty", "Off Duty", "Resting"][e.value] || "",
            },
            toolTip: {
                contentFormatter: (e) => {
                    const status =
                        ["", "Driving", "On Duty", "Off Duty", "Resting"][
                            e.entries[0].dataPoint.y
                            ] || "Undefined Status";
                    return `Status change at <b>${new Intl.DateTimeFormat("en", {
                        hour: "2-digit",
                        minute: "2-digit",
                    }).format(e.entries[0].dataPoint.x)}</b> to <b>${status}</b>`;
                },
            },
            data: [
                {
                    type: "stepLine",
                    dataPoints: entries.map((entry) => ({
                        x: new Date(entry.log_time),
                        y: parseInt(entry.status, 10),
                    })),
                },
            ],
        },
    });
};

const displayChartSelect = (e) => {
    const dateValue = e.target.value;
    const selected = schedules.value.find((s) => s.day === dateValue);
    if (selected) {
        selectedSchedule.value = selected;
        selectedSchedule.value.options.title.text = new Date(
            dateValue
        ).toDateString();
    }
};

onMounted(async () => {
    const userDriver = store.getters["user/user"]?.driver;
    if (!userDriver) {
        console.error("No driver data found in user store");
        return;
    }

    await getDriver(userDriver.id);
    getWorkingDays();
    daysToDisplay.value.forEach((day) => getDriverSchedule(day));
    if (schedules.value.length > 0) {
        selectedSchedule.value = schedules.value[0];
        selectedSchedule.value.options.title.text = new Date(
            schedules.value[0].day
        ).toDateString();
    }
});
</script>


<template>
    <h1 v-if="driver?.user?.name">
        {{ driver.user.name }}
    </h1>
    <p v-if="driver?.user?.email">{{ driver.user.email }}</p>

    <div v-if="schedules.length > 0">
        <div class="mb-4">
            <label class="form-label" for="schedule_date">Date:</label>
            <select
                class="form-select mx-4 w-25 d-inline"
                id="schedule_date"
                aria-label="Default select example"
                @change="displayChartSelect"
            >
                <option v-for="day in daysToDisplay" :key="day" :value="day">
                    {{ day }}
                </option>
            </select>
        </div>

        <CanvasJSChart
            class="my-3"
            :options="selectedSchedule?.options"
            :style="styleOptions"
        />
    </div>
    <div v-else>
        <h3>You do not have any schedule history</h3>
    </div>
</template>


<style scoped>

</style>

<script setup>
import { ref, computed, onMounted } from "vue";
import _axios from "../plugins/axios.js";
import store from "../store/index.js";

const currentStatus = ref(null);
const message = ref("");

const statuses = {
    Driving: 1,
    "On Duty": 2,
    "Off Duty": 3,
    Resting: 4,
};

const user = computed(() => store.getters["user/user"]);
const token = computed(() => store.getters["user/token"]);

const setStatus = async (status) => {
    currentStatus.value = status;

    try {
        const response = await _axios.post(
            "/api/schedule-entries",
            {
                status: statuses[status],
                driver_id: user.value.driver.id,
                log_time: new Date(),
                description: message.value,
                latitude: 40,
                longitude: 45,
            },
            {
                headers: { Authorization: `Bearer ${token.value}` },
            }
        );
        console.log(response);
    } catch (error) {
        console.error("Error setting status:", error);
    } finally {
        message.value = "";
    }
};

onMounted(() => {
    currentStatus.value = store.getters["user/status"];
});

</script>


<template>
    <div class="container text-center mt-5">
        <h1 class="mb-4">Choose Your Status</h1>
        <div class="btn-group" role="group" aria-label="Status Buttons">
            <button
                type="button"
                class="btn btn-primary"
                @click="setStatus('Driving')"
            >
                Driving
            </button>
            <button
                type="button"
                class="btn btn-secondary"
                @click="setStatus('On Duty')"
            >
                On-Duty
            </button>
            <button
                type="button"
                class="btn btn-success"
                @click="setStatus('Off Duty')"
            >
                Off-Duty
            </button>
            <button
                type="button"
                class="btn btn-danger"
                @click="setStatus('Resting')"
            >
                Resting
            </button>
        </div>
        <p class="mt-4" v-if="currentStatus">
            <strong>Current Status:</strong> {{ currentStatus }}
        </p>
        <div class="form-control mt-3">
            <label for="message" class="form-label">Message</label>
            <textarea name="message" id="message" cols="15" rows="10" class="form-control mt-4" v-model="message"></textarea>
        </div>
    </div>
</template>

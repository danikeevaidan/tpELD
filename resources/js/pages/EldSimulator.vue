<script>
    import _axios from '../plugins/axios.js';
    import store from '../store/index.js';

    export default {
        data() {
            return {
                currentStatus: null,
            };
        },
        methods: {
            async setStatus(status) {
                this.currentStatus = status;

                await _axios.post('/api/schedule-entries', {
                        status: status,
                        driver_id: store.getters['user/driver'].id,
                        log_time: new Date(),
                        description: 'Some Description',
                        latitude: 40,
                        longitude: 45
                    }, {
                    headers: {Authorization: `Bearer ${store.getters['user/token']}`                 }
                })
                    .then(res => {
                        console.log(res);
                    })
            },
        },
    };
</script>


<template>
    <div class="container text-center mt-5">
        <h1 class="mb-4">Choose Your Status</h1>
        <div class="btn-group" role="group" aria-label="Status Buttons">
            <button
                type="button"
                class="btn btn-primary"
                @click="setStatus('driving')"
            >
                Driving
            </button>
            <button
                type="button"
                class="btn btn-secondary"
                @click="setStatus('on_duty')"
            >
                On-Duty
            </button>
            <button
                type="button"
                class="btn btn-success"
                @click="setStatus('off_duty')"
            >
                Off-Duty
            </button>
            <button
                type="button"
                class="btn btn-danger"
                @click="setStatus('resting')"
            >
                Resting
            </button>
        </div>
        <p class="mt-4" v-if="currentStatus">
            <strong>Current Status:</strong> {{ currentStatus }}
        </p>
    </div>
</template>

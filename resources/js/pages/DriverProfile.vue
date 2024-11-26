<script>
    import axios from "axios";
    import * as CanvasJS  from '@canvasjs/charts';
    import store from '../store/index.js';

    export default {
        data: function () {
            return {
                driver: null,
                daysToDisplay: [],
                schedules: [],
                selectedSchedule: null,
                options: {},
                styleOptions: {
                    width: "100%",
                    height: "360px"
                }
            };
        },

        async mounted() {
            await this.getDriver(store.getters['user/driver'].id);
            this.getWorkingDays();
            for(let day in this.daysToDisplay) {
                this.getDriverSchedule(this.daysToDisplay[day]);
            }
            this.selectedSchedule = this.schedules[0];
            this.selectedSchedule.options.title.text = (new Date(this.schedules[0].day)).toDateString();
        },

        methods: {
            async getDriver(id) {
                await axios.get(`/api/drivers/${id}`)
                    .then(res => {
                        this.driver = res.data
                    })
                    .catch(error => console.log(error))
            },

            getWorkingDays() {
                for(let entry in this.driver.schedule_entries) {
                    this.daysToDisplay.push((new Date(this.driver.schedule_entries[entry].log_time)).toDateString())
                }
                this.daysToDisplay;
                this.daysToDisplay = [...new Set(this.daysToDisplay)];
            },

            getDriverSchedule(day) {
                let date;
                let entries = this.driver.schedule_entries.filter(function (entry) {
                    date = new Date(entry.log_time);
                    return date.toDateString() === day;
                }).sort()
                this.options = {
                    theme: "light2",
                    animationEnabled: true,
                    exportEnabled: true,
                    zoomEnabled:true,
                    exportFileName: `Driver ${this.driver.user?.name} ${date}`,
                    day: day,
                    title: {
                        text: ""
                    },
                    axisX: {
                        title: "Time",
                        labelFormatter: function(e) {
                            const formatter = new Intl.DateTimeFormat('en', { hour: '2-digit', minute: '2-digit'});
                            return formatter.format(e.value);
                        },
                        interval: 2
                    },
                    axisY: {
                        title: "Status",
                        labelFormatter: function(e){
                            switch (e.value) {
                                case 1: return 'Driving'
                                case 2: return 'On Duty'
                                case 3: return 'Off Duty'
                                case 4: return 'Resting'
                                default: return ''
                            }
                        },
                    },
                    toolTip: {
                        contentFormatter: function (e){
                            let status = () => {
                                switch(e.entries[0].dataPoint.y) {
                                    case 1: return 'Driving'
                                    case 2: return 'On Duty'
                                    case 3: return 'Off Duty'
                                    case 4: return 'Resting'
                                    default: return 'Undefined Status'
                                }
                            }
                            const formatter = new Intl.DateTimeFormat('en', { hour: '2-digit', minute: '2-digit'});
                            return "Status change at <b>" + formatter.format(e.entries[0].dataPoint.x) + "</b> to <b>"+ status() +"</b>";
                        }
                    },
                    data: [{
                        type: "stepLine",
                        dataPoints: []
                    }],
                };
                this.options.data[0].dataPoints = [];

                for(let i in entries) {
                    let log_time = new Date(entries[i].log_time);
                    this.options.data[0].dataPoints.push({
                        x: log_time,
                        y: parseInt(entries[i].status, 10)
                    });
                }

                this.schedules.push({day: day, options: this.options});
            },

            displayChartSelect(e) {
                let date_value = e.target.options[e.target.selectedIndex].value;
                this.selectedSchedule = this.schedules.filter(function(s) {
                    return s.day === date_value;
                })[0]
                this.selectedSchedule.options.title.text = (new Date(date_value)).toDateString()

            }
        }
    }

</script>

<template>
    <h1>
        {{ this.driver?.user?.name }}
    </h1>
    <p>{{this.driver?.user?.email}}</p>

    <div v-if="schedules.length>0">
        <div class="mb-4">
            <label class="form-label" for="schedule_date">Date:</label>
            <select class="form-select mx-4 w-25 d-inline" id="schedule_date" aria-label="Default select example" @change="displayChartSelect">
                <option v-for="day in this.daysToDisplay" :value="day">{{day}}</option>
            </select>
        </div>

        <CanvasJSChart class="my-3" :options="this.selectedSchedule?.options" :style="styleOptions"/>
    </div>
    <div v-else>
        <h3>You do not have any schedule history</h3>
    </div>

</template>

<style scoped>

</style>

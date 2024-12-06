import * as CanvasJS from '@canvasjs/charts';


class Chart{
    constructor(day, entries) {
        this.entries = entries;
        this.styleOptions = {
            width: "100%",
                height: "360px",
        }
        this.options = {
            theme: "light2",
                animationEnabled: true,
                exportEnabled: true,
                zoomEnabled: true,
                exportFileName: '',
                title: { text: day },
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
                    dataPoints: entries.map(entry => ({
                        x: new Date(entry.log_time),
                        y: parseInt(entry.status, 10),
                    })),
                },
            ],
        }
    }
}

function getWorkingDays(driver) {
    if (driver.schedule_entries) {
        return [
            ...new Set(
                driver.schedule_entries.map((entry) =>
                    new Date(entry.log_time).toDateString()
                )
            ),
        ];
    }
    return [];
}

function getChart(driver, schedule_entries, day) {
    if (schedule_entries) {
        const entries = schedule_entries.value
            .filter(entry => new Date(entry.log_time).toDateString() === day)
            .sort((a, b) => new Date(a.log_time) - new Date(b.log_time));
        return new Chart(day, entries);
    }
}

export {getWorkingDays, getChart};

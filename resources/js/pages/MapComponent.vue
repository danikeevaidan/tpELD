<template>
    <div>
        <div id="map" style="height: 500px; width: 100%;"></div>
    </div>
</template>

<script>
export default {
    name: "MapComponent",
    data() {
        return {
            map: null,
            markers: [],
        };
    },
    methods: {
        initMap() {
            this.map = new google.maps.Map(document.getElementById("map"), {
                center: { lat: 37.7749, lng: -122.4194 },
                zoom: 10,
            });

            this.loadTruckLocations();
        },
        async loadTruckLocations() {
            try {
                const response = await fetch("/api/trucks");
                const trucks = await response.json();

                trucks.forEach((truck) => {
                    const marker = new google.maps.Marker({
                        position: { lat: parseFloat(truck.latitude), lng: parseFloat(truck.longitude) },
                        map: this.map,
                        mounted() {
                            this.initMap();
                            setInterval(this.loadTruckLocations, 10000);
                        },
                        title: truck.name,
                    });

                    this.markers.push(marker);
                });
            } catch (error) {
                console.error("Ошибка загрузки данных: ", error);
            }
        },
    },
    mounted() {
        this.initMap();
    },
};
</script>

<style scoped>
#map {
    height: 100%;
    width: 100%;
}
</style>

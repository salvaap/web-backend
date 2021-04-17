<template>
    <bar-chart v-if="loaded" :chartData="chartdata" :options="chartoptions"></bar-chart>
</template>
<script>
import { BarChart } from '../../plugins/BarChart.js';

export default {
    name: 'SalesReport',
    data() {
        return {
            loaded: false,
            chartdata: {
                labels: ['Camiseta', 'Pantalon', 'Cargo Short', 'Tenis', 'Camiseta', 'Pantalon', 'Cargo Short', 'Tenis'],
                datasets: [
                    {
                        label: 'Reporte de Ventas',
                        backgroundColor: ['#3700B3', '#ff6732', '#bb86fc', '#ff0266', '#3700B3', '#ff6732', '#bb86fc', '#ff0266'],
                        data: [15, 30, 25, 40, 15, 30, 25, 40]
                    }
                ]
            },
            chartoptions: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {yAxes: [{ticks: {min: 0, max: 60}}]}
            },
        };
    },
    mounted() {
        this.loaded = true;
    },
    methods: {
        handle() {},
    }
}
</script>
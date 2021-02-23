<template>
    <bar-chart v-if="loaded" :chartData="chartdata" :options="chartoptions"></bar-chart>
</template>
<script>
import { BarChart } from '../plugins/BarChart.js';

export default {
    name: 'SalesHistory',
    data() {
        return {
            loaded: false,
            chartdata: {
                labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio'],
                datasets: [
                    {
                        label: 'Ventas',
                        backgroundColor: '#ff6732',
                        data: [42, 26, 38, 29, 30, 45]
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
<template>
    <doughnut-chart v-if="loaded" :chartData="chartdata" :options="chartoptions"></doughnut-chart>
</template>
<script>
import { DoughnutChart } from '../plugins/DoughnutChart.js';

export default {
    name: 'SalesApplication',
    data() {
        return {
            loaded: false,
            chartdata: {
                labels: ['Web', 'Móvil'],
                datasets: [
                    {
                        backgroundColor: ['#ffd63e', '#01dae5'],
                        data: [42, 26]
                    }
                ]
            },
            chartoptions: {
                responsive: true,
                maintainAspectRatio: false,
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
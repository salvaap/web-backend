import { Bar, mixins } from 'vue-chartjs';

export default {
    extends: Bar,
    mixins: [mixins.reactiveProp],
    props: {
        chartData: {
            type: Array|Object,
            default: null
        },
        options: {
            type: Object,
            default: null
        }
    },
    mounted() {
        this.renderChart(this.chartData, this.options);
    },
}
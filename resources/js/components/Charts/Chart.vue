<script type="text/ecmascript-6">
    import Chart from 'chart.js';

    export default {
        props: ['data', 'height', 'type', 'options'],

        data() {
            return {
                context: null,
                chart: null
            }
        },

        mounted() {
            this.context = this.$refs.canvas.getContext('2d');

            this.chart = new Chart(this.context, {
                type: this.type,
                data: this.data,
                options: this.options
            });
        },
    }
</script>

<template>
    <div>
        <canvas v-bind:height="height" ref="canvas"></canvas>
    </div>
</template>

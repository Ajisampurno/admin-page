<template>
    <div>
      <apexchart width="350" type="donut" :options="options" :series="series"></apexchart>
    </div>
</template>
<script>
import { defineComponent } from 'vue'
import VueApexCharts from 'vue3-apexcharts'

export default defineComponent({
  name: 'ChartComponent',
  components: {
    apexchart: VueApexCharts
  },
  data() {
    return {
      options: {},
      series: [44, 55, 41, 17, 15]
    }
  }
});
</script>
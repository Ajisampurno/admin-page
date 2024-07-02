<template>
  <div>
    <apexchart width="350" type="donut" :options="chartOptions" :series="series" class="my-6"></apexchart>
  </div>
</template>

<script>
import VueApexCharts from 'vue3-apexcharts'
import http from '@/plugins/axios'

export default {
  name: 'ChartComponent',
  components: {
    apexchart: VueApexCharts
  },
  props: {
    data: {
      type: Array,
      default: () => []
    }
  },
  computed: {
    chartOptions() {
      const labels = this.data.map(item => item.category_name);
      return {
        labels
      };
    },
    series() {
      return this.data.map(item => item.percentage);
    }
  }
};
</script>

<style scoped>
.my-6 {
  margin: 1.5rem 0;
}
</style>

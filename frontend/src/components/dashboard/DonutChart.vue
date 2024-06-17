<template>
  <div>
    <apexchart width="350" type="donut" :options="options" :series="series" class="my-6"></apexchart>
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
  data() {
    return {
      options: {
        labels: []
      },
      series: []
    }
  },
  mounted() {
    http.get('http://127.0.0.1:8000/api/dashboards')
      .then(response => {
        const data = response.data.categories_percentage;
        const data_series = data.map(item => item.percentage);
        const data_labels = data.map(item => item.category_name);

        this.series = data_series;
        this.options = {
          labels: data_labels
        };

      })
      .catch(error => {
        console.error("Fetching data error!", error);
      });
  }
};
</script>

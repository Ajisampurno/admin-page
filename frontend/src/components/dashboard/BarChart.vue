<template>
  <div>
    <apexchart width="350" type="bar" :options="options" :series="series" elevation-10></apexchart>
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
        chart: {
          id: ''
        },
        xaxis: {
          categories: []
        }
      },
      series: [{
        name: '',
        data: []
      }]
    }
  },
  mounted() {
    http.get('http://127.0.0.1:8000/api/dashboards')
      .then(response => {
        const data = response.data.users_by_year;
        const data_series = data.map(item => item.total_users);
        const data_categories = data.map(item => item.year);

        this.options = {
          chart: {
            id: 'vuechart-example'
          },
          xaxis:{
            categories: data_categories
          },
        };
        this.series= [
          {
            name: 'series-1',
            data: data_series
          }
        ]
      })
      .catch(error => {
        console.error("Fetching data error!", error);
      });
  }
}
</script>

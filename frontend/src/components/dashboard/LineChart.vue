<template>
    <div>
      <apexchart width="760" type="line" :options="options" :series="series"></apexchart>
    </div>
</template>

<script>
import VueApexCharts from 'vue3-apexcharts'
import http from '@/plugins/axios'

export default {
  name: 'ChartComponent',
  props: {
    data:{
      default: null
    }
  },
  components: {
    apexchart: VueApexCharts
  },
  data() {
    return {
    }
  },
  computed: {
    options(){
      if (this.data) {
        const data_categories = this.data.map(item => item.year);  
        return {
          chart: {
            id: 'vuechart-example'
          },
          xaxis:{
            categories: data_categories
          },
        }
      }else{
        return {
          chart: {
            id: 'vuechart-example'
          },
          xaxis:{
            categories: []
          },
        }
      }
    },
    series(){
      if (this.data) {
        
        const data_series = this.data.map(item => item.total_orders);
        return [
          {
            name: 'Total penjualan:',
            data: data_series
          }
        ]
      }else{
        return [
          {
            name: 'Total penjualan:',
            data: []
          }
        ]
      }
      }
  }
}
</script>

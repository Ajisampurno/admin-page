
<template>
    <v-container>
        <v-row justify="center">
            <v-col cols="12" md="12" sm="12">
                <CardGroup :data="dataDashboard" />
            </v-col>
        </v-row>
    </v-container>
    <v-container>
        <v-row justify="center">
            <v-col cols="12" md="8" sm="6">
                <v-card elevation="3" title="Line Chart">
                    <LineChart :data="dataDashboard.orders_by_year"/>
                </v-card>
            </v-col>
            <v-col cols="12" md="4" sm="6">
                <v-card elevation="3" title="Donut Chart">
                    <DonutChart :data="dataDashboard.categories_percentage" />
                </v-card>
                <v-card elevation="3" title="Bar Chart" class="mt-2">
                    <BarChart :data="dataDashboard.users_by_year" />
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>

<script lang="ts">
import http from '@/plugins/axios'
export default{
    data() {
        return {
            dataDashboard: {}
        }
    },
    mounted() {
    http.get('http://127.0.0.1:8000/api/dashboards')
      .then(response => {
        this.dataDashboard = response.data.data;
      })
      .catch(error => {
        console.error("Fetching data error!", error);
      });
  }
}
</script>
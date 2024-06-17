<template>
    <v-row align="center" justify="center" dense>
        <v-col cols="12" md="3" sm="3">
            <v-card
                append-icon="mdi-open-in-new"
                class="mx-auto"
                to="/user"
                max-width="344"
                prepend-icon="mdi-account"
                rel="noopener"
                :subtitle="`Total User: ${data_user}`"
                target="_blank"
                title="User"
                elevation="3"
                color="pink-accent-2"
            ></v-card>
        </v-col>
        <v-col cols="12" md="3" sm="3">
            <v-card
                append-icon="mdi-open-in-new"
                class="mx-auto"
                max-width="344"
                prepend-icon="mdi-package-variant"
                rel="noopener"
                :subtitle="`Total Product: ${data_product}`"
                target="_blank"
                title="Product"
                elevation="3"
                color="orange-accent-2"
            ></v-card>
        </v-col>
        <v-col cols="12" md="3" sm="3">
            <v-card
                append-icon="mdi-open-in-new"
                class="mx-auto"
                max-width="344"
                prepend-icon="mdi-shape"
                rel="noopener"
                :subtitle="`Total Categorie: ${data_categorie}`"
                target="_blank"
                title="Categorie"
                elevation="3"
                color="green-accent-2"
            ></v-card>
        </v-col>
        <v-col cols="12" md="3" sm="3">
            <v-card
                append-icon="mdi-open-in-new"
                class="mx-auto"
                max-width="344"
                prepend-icon="mdi-cart"
                rel="noopener"
                :subtitle="`Total Order: ${data_order}`"
                target="_blank"
                title="Order"
                elevation="3"
                color="blue-accent-2"
            ></v-card>
        </v-col>
    </v-row>
</template>

<script>
import http from '@/plugins/axios'

export default {
  name: 'ChartComponent',
  data() {
    return {
      data_user: '',
      data_product: '',
      data_categorie: '',
      data_order: '',
    }
  },
  mounted() {
    http.get('http://127.0.0.1:8000/api/dashboards')
      .then(response => {
        this.data_user = response.data.user_count;
        this.data_product = response.data.product_count;
        this.data_categorie = response.data.categorie_count;
        this.data_order = response.data.order_count;
      })
      .catch(error => {
        console.error("Fetching data error!", error);
      });
  }
};
</script>

<template>
  <div>
    <div class="row">
      <div class="col-12">
        <card :title="table1.title" :subTitle="table1.subTitle">
          <div slot="raw-content" class="table-responsive">
            <paper-table :data="table1.data" :columns="table1.columns"></paper-table>
          </div>
        </card>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import { PaperTable } from "@/components";

export default {
  components: {
    PaperTable
  },
  data() {
    return {
      table1: {
        title: "Categories Table",
        subTitle: "Categories",
        columns: ["id", "pd_id", "amount"],
        data: [],
      },
    };
  },
  methods: {
    fetchData() {
      axios.get('http://127.0.0.1:8000/api/orders')
        .then(response => {
          this.table1.data = response.data;
        })
        .catch(error => {
          console.error('Error fetching orders:', error);
        });
    },
  },
  mounted() {
    this.fetchData();
  },
}
</script>

<style></style>

<template>
  <div>
    <div class="row">
      <div class="col-12">
        <router-link to="/create-order" class="btn btn-primary mb-2">
          Create Data
        </router-link>
        <card :title="table1.title" :subTitle="table1.subTitle">
          <div slot="raw-content" class="table-responsive">
            <paper-table :data="table1.data" :columns="table1.columns" :handle-delete="handleDelete">
            </paper-table>
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
        title: "Order Table",
        subTitle: "Table of Orders",
        columns: ["id", "pd_id", "amount", "action"],
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
    handleDelete(item) {
      if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
      axios.delete(`http://127.0.0.1:8000/api/orders/${item.id}`)
        .then(response => {
          console.log('Deleted:', response.data);
          this.fetchData();
        })
        .catch(error => {
          console.error('Error deleting:', error);
        });
      }
    }
  },
  mounted() {
    this.fetchData();
  },
}
</script>

<style></style>

<template>
  <v-container>
    <!-- Snackbar for notifications -->
    <v-snackbar v-model="snackbar" :timeout="3000">
      {{ snackbarMessage }}
      <v-btn color="success" varian="text" @click="snackbar = false">Close</v-btn>
    </v-snackbar>

    <!-- Delete confirmation dialog -->
    <v-dialog v-model="confirmDialog" max-width="500">
      <v-card>
        <v-card-title class="headline">Confirm Delete</v-card-title>
        <v-card-text>
          Are you sure you want to delete this item?
        </v-card-text>
        <v-card-actions>
          <v-btn color="blue darken-1" @click="confirmDialog = false">Cancel</v-btn>
          <v-btn color="red darken-1" @click="deleteConfirmed">Delete</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <!-- Add dialog -->
    <v-dialog v-model="addDialog" max-width="500">
      <v-card>
        <v-card-title class="headline">Add Product</v-card-title>
        <v-card-text>
          <v-container>
            <v-form ref="addForm">
              <v-select
                v-model="newItem.product_id"
                :items="products"
                item-text="name"
                item-title="name"
                item-value="id"
                label="Product"
              ></v-select>
              <v-text-field v-model="newItem.amount" label="amount" type="number"></v-text-field>
            </v-form>
          </v-container>
        </v-card-text>
        <v-card-actions>
          <v-btn color="blue darken-1" @click="addDialog = false">Cancel</v-btn>
          <v-btn color="green darken-1" @click="save">Add</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <!-- Edit dialog -->
    <v-dialog v-model="editDialog" max-width="500">
      <v-card>
        <v-card-title class="headline">Edit Product</v-card-title>
        <v-card-text>
          <v-container>
            <v-form ref="editForm">
              <v-select
                v-model="editedItem.product_id"
                :items="products"
                item-text="name"
                item-title="name"
                item-value="id"
                label="Product"
                ></v-select>
              <v-text-field v-model="editedItem.amount" label="amount" type="number"></v-text-field>
            </v-form>
          </v-container>
        </v-card-text>
        <v-card-actions>
          <v-btn color="blue darken-1" @click="editDialog = false">Cancel</v-btn>
          <v-btn color="green darken-1" @click="saveChanges">Save</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <!-- Data table -->
    <v-card color="primary" class="d-flex flex-column flex-md-row pa-4">
      <v-card-title class="mt-2">
        <h2>Product</h2>
      </v-card-title>
      <v-spacer></v-spacer>
      <v-text-field
        v-model="searchQuery"
        label="Search"
        variant="solo"
        clearable
        append-inner-icon="mdi-magnify"
        density="compact"
        class="mt-5 me-md-2 me-0"
      ></v-text-field>
      <v-select
        v-model="selectedproduct"
        :items="products"
        item-title="name"
        item-text="name"
        item-value="product_name"
        label="Filter by Products"
        clearable
        variant="solo"
        density="compact"
        class="mt-5 me-md-2 me-0"
      ></v-select>
      <v-select
        v-model="selectedcategorie"
        :items="categories"
        item-title="name"
        item-text="name"
        item-value="categorie_name"
        label="Filter by Categories"
        clearable
        variant="solo"
        density="compact"
        class="mt-5"
      ></v-select>
      <v-btn icon="mdi-plus" size="x-large" variant="text" class="mt-5 mt-md-0" @click="addItem"></v-btn>
    </v-card>

    <v-data-table
      :headers="headers"
      :items="filteredItems"
      :items-per-page="10"
      height="300"
      mobile-breakpoint="600"
      class="elevation-20"
    >
      <template v-slot:item.action="{ item }">
        <v-icon color="blue darken-1" small @click="editItem(item)">
          mdi-pencil
        </v-icon>
        <v-icon color="red darken-1" small @click="confirmDelete(item)">
          mdi-delete
        </v-icon>
      </template>
    </v-data-table>
  </v-container>
</template>
<script>
import http from "@/plugins/axios";

export default {
  data() {
    return {
      searchQuery: '',
      selectedproduct: null,
      selectedcategorie: null,
      datas: [],
      products: [],
      categories: [],
      headers: [
        { title: 'ID', key: 'id', align: 'start', sortable: true },
        { title: 'Product', key: 'product_name', align: 'start', sortable: true },
        { title: 'Categories', key: 'categorie_name', align: 'start', sortable: false },
        { title: 'Amount', key: 'amount', align: 'start', sortable: true },
        { title: 'Actions', key: 'action', sortable: false },
    ],
      confirmDialog: false,
      itemToDelete: null,
      addDialog: false,
      editDialog: false,
      newItem: {
        name: '',
        product_id: null,
        amount: null,
      },
      editedItem: {
        product_id: null,
        amount: null,
      },
      snackbar: false,
      snackbarMessage: '',
    };
  },
  created() {
    this.fetchData();
    this.fetchProducts();
    this.fetchCategories();
  },
  computed: {
    filteredItems() {
      let items = this.datas;
      if (this.searchQuery) {
        items = items.filter(item =>
          item.product_name.toLowerCase().includes(this.searchQuery.toLowerCase())
        );
      }
      if (this.selectedproduct) {
        items = items.filter(item => item.product_name === this.selectedproduct);
      }
      if (this.selectedcategorie) {
        items = items.filter(item => item.categorie_name === this.selectedcategorie);
      }
      return items;
    },
  },
  methods: {
    fetchData() {
      http.get('/orders')
        .then(response => {
          this.datas = response.data;
        })
        .catch(error => {
          console.error('Error fetching data:', error);
        });
    },
    fetchProducts() {
      http.get('/products')
        .then(response => {
          this.products = response.data;
        })
        .catch(error => {
          console.error('Error fetching categories:', error);
        });
    },
    fetchCategories() {
      http.get('/categories')
        .then(response => {
          this.categories = response.data;
        })
        .catch(error => {
          console.error('Error fetching categories:', error);
        });
    },
    addItem() {
      this.addDialog = true;
    },
    save() {
      this.$refs.addForm.validate().then(success => {
        if (success) {
          http.post('/orders', {
            product_id: this.newItem.product_id,
            amount: this.newItem.amount,
          })
          .then(response => {
            this.fetchData();
            this.addDialog = false;
            this.snackbarMessage = 'Product added successfully.';
            this.snackbar = true;
            this.newItem = { product_id: null, amount: null };
          })
          .catch(error => {
            console.error('Error adding data:', error);
          });
        }
      });
    },
    editItem(item) {
      this.editedItem = { ...item, product_id: item.product_id };
      this.editDialog = true;
    },
    saveChanges() {
      this.$refs.editForm.validate().then(success => {
        if (success) {
          http.put(`/orders/${this.editedItem.id}`, {
            product_id: this.editedItem.product_id,
            amount: this.editedItem.amount,
          })
          .then(response => {
            this.fetchData();
            this.editDialog = false;
            this.snackbarMessage = 'Product updated successfully.';
            this.snackbar = true;
          })
          .catch(error => {
            console.error('Error updating product:', error);
          });
        }
      });
    },
    confirmDelete(item) {
      this.itemToDelete = item;
      this.confirmDialog = true;
    },
    deleteConfirmed() {
      if (this.itemToDelete) {
        http.delete(`/orders/${this.itemToDelete.id}`)
          .then(response => {
            this.fetchData();
            this.snackbarMessage = 'Product deleted successfully.';
            this.snackbar = true;
            this.confirmDialog = false;
          })
          .catch(error => {
            console.error('Error deleting product:', error);
          })
          .finally(() => {
            this.itemToDelete = null;
          });
      }
    },
  },
};
</script>

<style>
@media (max-width: 600px) {
  .v-data-table-header .column-to-hide, 
  .v-data-table__wrapper .column-to-hide,
  .v- {
    display: none;
  }

  .v-card-title {
    text-align: center;
  }
}
</style>
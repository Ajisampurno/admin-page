<template>
  <v-container>
    <!-- Snackbar for notifications -->
    <v-snackbar v-model="snackbar" :timeout="3000" color="success">
      {{ snackbarMessage }}
      <v-btn text @click="snackbar = false">Close</v-btn>
    </v-snackbar>

    <!-- Delete confirmation dialog -->
    <v-dialog v-model="confirmDialog" max-width="500">
      <v-card>
        <v-card-title class="headline">Confirm Delete</v-card-title>
        <v-card-text>
          Are you sure you want to delete this item?
        </v-card-text>
        <v-card-actions>
          <v-btn color="blue darken-1" text @click="confirmDialog = false">Cancel</v-btn>
          <v-btn color="red darken-1" text @click="deleteConfirmed">Delete</v-btn>
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
              <v-text-field v-model="newItem.name" label="Name"></v-text-field>
            </v-form>
          </v-container>
        </v-card-text>
        <v-card-actions>
          <v-btn color="blue darken-1" text @click="addDialog = false">Cancel</v-btn>
          <v-btn color="green darken-1" text @click="save">Add</v-btn>
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
              <v-text-field v-model="editedItem.name" label="Name"></v-text-field>
            </v-form>
          </v-container>
        </v-card-text>
        <v-card-actions>
          <v-btn color="blue darken-1" text @click="editDialog = false">Cancel</v-btn>
          <v-btn color="green darken-1" text @click="saveChanges">Save</v-btn>
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
      <v-btn icon="mdi-plus" size="x-large" variant="text" class="mt-5 mt-md-0" @click="addItem"></v-btn>
    </v-card>

    <v-data-table
      :headers="headers"
      :items="filteredItems"
      :items-per-page="10"
      height="300"
      mobile-breakpoint="600"
      class="elevation-1"
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
<script lang="ts">
import axios from 'axios';

export default {
  data() {
    return {
      searchQuery: '',
      selectedCategory: null,
      datas: [],
      categories: [],
      headers: [
        { title: 'ID', key: 'id', align: 'start', sortable: true },
        { title: 'Name', key: 'name', align: 'start', sortable: true },
        { title: 'Actions', key: 'action', sortable: false },
    ],
      confirmDialog: false,
      itemToDelete: null,
      addDialog: false,
      editDialog: false,
      newItem: {
        name: '',
      },
      editedItem: {
        name: '',
      },
      snackbar: false,
      snackbarMessage: '',
    };
  },
  created() {
    this.fetchData();
  },
  computed: {
    filteredItems() {
      let items = this.datas;

      if (this.searchQuery) {
        items = items.filter(item =>
          item.name.toLowerCase().includes(this.searchQuery.toLowerCase())
        );
      }
      return items;
    },
  },
  methods: {
    fetchData() {
      axios.get('http://127.0.0.1:8000/api/categories')
        .then(response => {
          this.datas = response.data;
        })
        .catch(error => {
          console.error('Error fetching data:', error);
        });
    },
    addItem() {
      this.addDialog = true;
    },
    save() {
      this.$refs.addForm.validate().then(success => {
        if (success) {
          axios.post('http://127.0.0.1:8000/api/categories', {
            name: this.newItem.name
          })
          .then(response => {
            this.fetchData();
            this.addDialog = false;
            this.snackbarMessage = 'Product added successfully.';
            this.snackbar = true;
            this.newItem = { name: ''};
          })
          .catch(error => {
            console.error('Error adding product:', error);
          });
        }
      });
    },
    editItem(item) {
      this.editedItem = { ...item};
      this.editDialog = true;
    },
    saveChanges() {
      this.$refs.editForm.validate().then(success => {
        if (success) {
          axios.put(`http://127.0.0.1:8000/api/categories/${this.editedItem.id}`, {
            name: this.editedItem.name,
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
      console.log(this.itemToDelete)
      if (this.itemToDelete) {
        axios.delete(`http://127.0.0.1:8000/api/categories/${this.itemToDelete.id}`)
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
<template>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <card class="cart-user">
                <div class="cart-header">
                    <h1 class="card-title">Edit Data</h1>
                </div>
                <div class="cart-body">
                    <div class="edit-order">
                        <form @submit.prevent="updateData" class="edit-order-form">
                            <div class="form-group">
                                <label for="code">Code:</label>
                                <input type="text" class="form-control border" id="code" v-model="formData.code">
                            </div>
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" class="form-control border" id="name" v-model="formData.name">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </card>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            formData: {
                code: '',
                name: ''
            }
        };
    },
    methods: {
        fetchData() {
            const id = this.$route.params.id;
            axios.get(`http://127.0.0.1:8000/api/categories/${id}`)
                .then(response => {
                    this.formData = response.data;
                })
                .catch(error => {
                    console.error('Error fetching order:', error);
                });
        },
        updateData() {
            const id = this.$route.params.id;
            axios.put(`http://127.0.0.1:8000/api/categories/${id}`, this.formData)
                .then(response => {
                    alert('Data berhasil di ubah');
                    this.$router.push('/categorie');
                })
                .catch(error => {
                    console.error('Error updating order:', error);
                });
        }
    },
    mounted() {
        this.fetchData();
    }
};
</script>

<style scoped>

.edit-order {
    margin: 20px;
}

.edit-order h1 {
    margin-bottom: 20px;
}

.edit-order-form {
    max-width: 400px;
    margin: auto;
}
</style>

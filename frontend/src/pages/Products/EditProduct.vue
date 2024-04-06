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
                                <input type="text" class="form-control border" id="code" v-model="data.code">
                            </div>
                            <div class="form-group">
                                <label for="ct_id">Categorie ID:</label>
                                <input type="text" class="form-control border" id="ct_id" v-model.number="data.ct_id">
                            </div>
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" class="form-control border" id="name" v-model="data.name">
                            </div>
                            <div class="form-group">
                                <label for="price">Price:</label>
                                <input type="text" class="form-control border" id="price" v-model="data.price">
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
            data: {
                pd_id: '',
                amount: 0
            }
        };
    },
    methods: {
        fetchdata() {
            const id = this.$route.params.id;
            axios.get(`http://127.0.0.1:8000/api/products/${id}`)
                .then(response => {
                    this.data = response.data;
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                });
        },
        updateData() {
            const id = this.$route.params.id;
            axios.put(`http://127.0.0.1:8000/api/products/${id}`, this.data)
                .then(response => {
                    alert('Data berhasil di ubah');
                    this.$router.push('/products');
                })
                .catch(error => {
                    console.error('Error updating data:', error);
                });
        }
    },
    mounted() {
        this.fetchOrder();
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

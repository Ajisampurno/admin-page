<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h1 class="card-title">Create Data</h1>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="createData">
                            <div class="form-group">
                                <label for="code">Code:</label>
                                <input type="text" class="form-control border" id="code" v-model="code">
                            </div>
                            <div class="form-group">
                                <label for="ct_id">Categorie ID:</label>
                                <input type="text" class="form-control border" id="ct_id" v-model.number="ct_id">
                            </div>
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" class="form-control border" id="name" v-model="name">
                            </div>
                            <div class="form-group">
                                <label for="price">Price:</label>
                                <input type="text" class="form-control border" id="price" v-model="price">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            code: '',
            ct_id: '',
            name: '',
            price: ''
        };
    },
    methods: {
        createData() {
            axios.post('http://127.0.0.1:8000/api/products', {
                pd_id: this.pd_id,
                amount: this.amount
            })
                .then(response => {
                    console.log('Order created:', response.data);
                    alert('Data berhasil di tambahan');
                    this.$router.push('/order');
                })
                .catch(error => {
                    console.error('Error creating order:', error);
                });
        }
    }
};
</script>

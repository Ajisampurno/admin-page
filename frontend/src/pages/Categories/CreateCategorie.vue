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
                                <label for="pd_id">Product ID:</label>
                                <input type="text" class="form-control border" id="pd_id" v-model="pd_id">
                            </div>
                            <div class="form-group">
                                <label for="amount">Amount:</label>
                                <input type="number" class="form-control border" id="amount" v-model.number="amount">
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
            pd_id: '',
            amount: 0
        };
    },
    methods: {
        createData() {
            axios.post('http://127.0.0.1:8000/api/categories', {
                pd_id: this.pd_id,
                amount: this.amount
            })
                .then(response => {
                    console.log('Order created:', response.data);
                    alert('Data berhasil di tambahan');
                    this.$router.push('/categorie');
                })
                .catch(error => {
                    console.error('Error creating categorie:', error);
                });
        }
    }
};
</script>

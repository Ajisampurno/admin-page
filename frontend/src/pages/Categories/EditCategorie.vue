<template>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <card class="cart-user">
                <div class="cart-header">
                    <h1 class="card-title">Edit Data</h1>
                </div>
                <div class="cart-body">
                    <div class="edit-data">
                        <form @submit.prevent="updatedata" class="edit-data-form">
                            <div class="form-group">
                                <label for="pd_id">Product ID:</label>
                                <input type="text" id="pd_id" v-model="data.pd_id" class="form-control border">
                            </div>
                            <div class="form-group">
                                <label for="amount">Amount:</label>
                                <input type="number" id="amount" v-model.number="data.amount"
                                    class="form-control border">
                            </div>
                            <button type="submit" class="btn btn-primary">Update Data</button>
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
        fetchOrder() {
            const dataId = this.$route.params.id;
            axios.get(`http://127.0.0.1:8000/api/categories/${dataId}`)
                .then(response => {
                    this.data = response.data;
                })
                .catch(error => {
                    console.error('Error fetching categorie:', error);
                });
        },
        updateOrder() {
            const dataId = this.$route.params.id;
            axios.put(`http://127.0.0.1:8000/api/categories/${dataId}`, this.data)
                .then(response => {
                    alert('Data berhasil di ubah');
                    this.$router.push('/categorie');
                })
                .catch(error => {
                    console.error('Error updating categorie:', error);
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

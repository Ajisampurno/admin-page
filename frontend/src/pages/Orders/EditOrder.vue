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
                                <label for="pd_id">pd_id:</label>
                                <input type="text" id="pd_id" v-model="formData.pd_id" class="form-control border">
                            </div>
                            <div class="form-group">
                                <label for="amount">Amount:</label>
                                <input type="number" id="amount" v-model.number="formData.amount"
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
            formData: {
                pd_id: '',
                amount: ''
            }
        };
    },
    methods: {
        fetchData() {
            const id = this.$route.params.id;
            axios.get(`http://127.0.0.1:8000/api/orders/${id}`)
                .then(response => {
                    this.formData = response.data;
                })
                .catch(error => {
                    console.error('Error fetching order:', error);
                });
        },
        updateData() {
            const id = this.$route.params.id;
            axios.put(`http://127.0.0.1:8000/api/orders/${id}`, this.formData)
                .then(response => {
                    alert('Data berhasil di ubah');
                    this.$router.push('/order');
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

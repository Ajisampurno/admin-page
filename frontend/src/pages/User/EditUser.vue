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
                                <label for="name">name:</label>
                                <input type="text" id="name" v-model="formData.name" class="form-control border">
                            </div>
                            <div class="form-group">
                                <label for="email">email:</label>
                                <input type="text" id="email" v-model="formData.email" class="form-control border">
                            </div>
                            <div class="form-group">
                                <label for="phone_number">phone_number:</label>
                                <input type="text" id="phone_number" v-model="formData.phone_number" class="form-control border">
                            </div>
                            <div class="form-group">
                                <label for="address">address:</label>
                                <input type="text" id="address" v-model="formData.address" class="form-control border">
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
                name: '',
                email: '',
                phone_number:'',
                address:'',
            }
        };
    },
    methods: {
        fetchData() {
            const dataId = this.$route.params.id;
            axios.get(`http://127.0.0.1:8000/api/users/${dataId}`)
                .then(response => {
                    this.formData = response.data;
                })
                .catch(error => {
                    console.error('Error fetching order:', error);
                });
        },
        updateData() {
            const dataId = this.$route.params.id;
            axios.put(`http://127.0.0.1:8000/api/users/${dataId}`, this.formData)
                .then(response => {
                    alert('Data berhasil di ubah');
                    this.$router.push('/manage-user');
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

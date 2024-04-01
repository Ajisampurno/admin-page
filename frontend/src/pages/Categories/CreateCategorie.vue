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
                                <label for="name">Name:</label>
                                <input type="text" class="form-control border" id="name" v-model="name">
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
            name: ''
        };
    },
    methods: {
        createData() {
            axios.post('http://127.0.0.1:8000/api/categories', {
                code: this.code,
                name: this.name
            })
                .then(response => {
                    alert('Data berhasil di tambahan');
                    this.$router.push('/categorie');
                })
                .catch(error => {
                    console.error('Error creating data:', error);
                });
        }
    }
};
</script>

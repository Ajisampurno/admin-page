<!-- Register.vue -->
<template>
  <div class="container">
    <div class="row justify-content-center mt-5">
      <div class="col-md-6">
        <div class="card border">
          <div class="card-header">{{ title }}</div>
          <div class="card-body">
            <form @submit.prevent="register">
              <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control border" id="name" v-model="name" placeholder="Enter name">
              </div>
              <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control border" id="email" v-model="email" placeholder="Enter email">
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control border" id="password" v-model="password" placeholder="Password">
              </div>
              <button type="submit" class="btn btn-primary">Register</button>
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
      name: '',
      email: '',
      password: '',
      title: 'Registration Form'
    }
  },
  methods: {
    register() {
      axios.post('http://127.0.0.1:8000/api/register', {
        name: this.name,
        email: this.email,
        password: this.password
      })
      .then(response => {
        console.log(response.data);
        alert('Registrasi berhasil')
      })
      .catch(error => {
        console.error('Registration failed:', error);
        alert('Registrasi gagal');
      });
    }
  }
}
</script>

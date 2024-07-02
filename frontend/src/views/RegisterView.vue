<template>
  <v-card class="mx-auto px-6 py-8 mt-12" max-width="344">
    <v-form v-model="form" @submit.prevent="onSubmit">
      <v-text-field v-model="name" :readonly="loading" :rules="[required]" class="mb-2" label="Name" clearable></v-text-field>
      <v-text-field v-model="email" :readonly="loading" :rules="[required]" class="mb-2" label="Email" clearable></v-text-field>
      <v-text-field v-model="phone_number" :readonly="loading" :rules="[required]" class="mb-2" label="Phone Number" clearable></v-text-field>
      <v-text-field v-model="address" :readonly="loading" :rules="[required]" class="mb-2" label="Address" clearable></v-text-field>
      <v-text-field v-model="password" :readonly="loading" :rules="[required]" type="password" label="Password" placeholder="Enter your password" clearable></v-text-field>
      <v-text-field v-model="password_confirm" :readonly="loading" :rules="[required]" type="password" label="Password Confirm" placeholder="Confirm your password" clearable></v-text-field>
      <v-btn :disabled="!form" :loading="loading" color="success" size="large" type="submit" variant="elevated" block>Register</v-btn>
    </v-form>
  </v-card>
</template>

<script>
import http from "@/plugins/axios";

export default {
  data() {
    return {
      form: true,
      loading: false,
      name: '',
      email: '',
      phone_number: '',
      address: '',
      password: '',
      password_confirm: '',
      required: v => !!v || 'This field is required',
    };
  },
  methods: {
    
    async onSubmit() {
      this.loading = true;
      try {
        const response = await http.post('https://essasentosa.my.id/api/register', {
          name: this.name,
          email: this.email,
          phone_number: this.phone_number,
          address: this.address,
          password: this.password,
          password_confirmation: this.password_confirm,
        });
        this.loading = false;
        console.log('Registration successful', response.data);
        this.$router.push({ name: 'login' });
        alert('Registrasi success');
        // Handle successful registration (e.g., redirect to login page)
      } catch (error) {
        this.loading = false;
        console.error('Registration failed', error.response.data);
        // Handle registration errors
      }
    },
  },
};
</script>

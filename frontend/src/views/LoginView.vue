<!-- components/Login.vue -->
<template>
  <v-card class="mx-auto px-6 py-8 mt-12" max-width="344">
    <v-form v-model="form" @submit.prevent="onSubmit">
      <v-alert v-if="error" type="error">{{ error }}</v-alert>
      <v-text-field v-model="email" :readonly="loading" :rules="[required]" class="mb-2" label="Email" clearable></v-text-field>
      <v-text-field v-model="password" :readonly="loading" :rules="[required]" type="password" label="Password" clearable></v-text-field>
      <v-btn :disabled="!form" :loading="loading" color="success" size="large" type="submit" variant="elevated" block>Login</v-btn>
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
      email: '',
      password: '',
      error: '',
      required: v => !!v || 'This field is required',
    };
  },
  methods: {
    async onSubmit() {
      this.loading = true;
      this.error = '';
      try {
        const response = await http.post('https://essasentosa.my.id/api/login', {
          email: this.email,
          password: this.password,
        });
        this.loading = false;
        console.log('Login successful', response.data);
        localStorage.setItem('token', response.data.token);
        this.$router.push({ name: 'dashboard' });
      } catch (error) {
        this.loading = false;
        this.error = 'Login failed: ' + (error.response.data.message || 'Unknown error');
        console.error('Login failed', error.response.data);
      }
    },
  },
};
</script>

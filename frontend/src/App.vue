<template>
  <v-app>
    <v-card>
      <v-layout>
        <template v-if="route.name !== 'login' && route.name !== 'register'">
          <Navigasi />
        </template>
        <v-main>
          <v-parallax src="@/assets/background.jpg">
            <router-view></router-view>
          </v-parallax>
          <template v-if="route.name !== 'login' && route.name !== 'register'">
            <Footer />
          </template>
        </v-main>
      </v-layout>
    </v-card>
  </v-app>
</template>

<script >
import { useRoute } from 'vue-router';
import { defineComponent } from 'vue';

export default defineComponent({
  setup() {
    const route = useRoute();
    return { route };
  },
});
</script>

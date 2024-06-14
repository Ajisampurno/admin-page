<!-- src/App.vue -->
<template>
  <v-app>
    <v-card>
    <v-layout>
      <v-app-bar color="primary" prominent>
        <v-app-bar-nav-icon variant="text" @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
        <v-toolbar-title>My Admin</v-toolbar-title>
        <v-spacer></v-spacer>
        <template v-if="$vuetify.display.mdAndUp">
          <v-btn icon="mdi-magnify" variant="text"></v-btn>
          <v-btn icon="mdi-filter" variant="text"></v-btn>
        </template>
        <v-btn icon="mdi-dots-vertical" variant="text"></v-btn>
      </v-app-bar>

      <v-navigation-drawer
        v-model="drawer"
        :location="$vuetify.display.mobile ? 'bottom' : undefined"
        temporary
      >
        <v-list>
          <v-list-item
            v-for="item in items"
            :key="item.value"
            :to="item.route"
            tag="router-link"
            class="ListMenu"
            active-class="active-item"
          >
            <div class="d-flex">
              <v-list-item-icon>
                <v-icon>{{ item.icon }}</v-icon>
              </v-list-item-icon>
              <v-list-item-content class="ms-2">
                <v-list-item-title>{{ item.title }}</v-list-item-title>
              </v-list-item-content>
            </div>
          </v-list-item>
        </v-list>
      </v-navigation-drawer>
      <v-main>
        <router-view></router-view>
      </v-main>
    </v-layout>
  </v-card>
</v-app>
</template>

<script lang="ts">
export default {
  data: () => ({
    drawer: false,
    items: [
      {
        title: 'Dashboard',
        value: 'dashboard',
        icon: 'mdi-view-dashboard',
        route: '/dashboard'
      },
      {
        title: 'Manage Users',
        value: 'manage-users',
        icon: 'mdi-account',
        route: '/user'
      },
      {
        title: 'Products',
        value: 'products',
        icon: 'mdi-package-variant',
        route: '/product'
      },
      {
        title: 'Category',
        value: 'categories',
        icon: 'mdi-shape',
        route: '/categorie'
      },
      {
        title: 'Orders',
        value: 'orders',
        icon: 'mdi-cart',
        route: '/orders'
      },
    ],
  })
}
</script>

<style scoped>
.ListMenu {
  transition: background-color 0.3s;
}

.ListMenu:hover {
  background-color: rgba(0, 0, 0, 0.1);
}

.active-item {
  background-color: rgba(0, 0, 0, 0.2) !important;
}
</style>

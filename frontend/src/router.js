// src/router.js
import { createRouter, createWebHistory } from 'vue-router';
import ProductView from '@/views/ProductView.vue';
import UserView from '@/views/UserView.vue';
import CategorieView from '@/views/CategorieView.vue';

const routes = [
  {
    path: '/product',
    name: 'product',
    component: ProductView
  },
  {
    path: '/user',
    name: 'user',
    component: UserView
  },
  {
    path: '/categorie',
    name: 'categorie',
    component: CategorieView
  }
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;

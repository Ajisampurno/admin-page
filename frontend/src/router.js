// src/router.js
import { createRouter, createWebHistory } from 'vue-router';
import ProductView from '@/views/ProductView.vue';
import UserView from '@/views/UserView.vue';
import CategorieView from '@/views/CategorieView.vue';
import OrderView from '@/views/OrderView.vue';
import DashboardView from '@/views/DashboardView.vue';
import LoginView from './views/LoginView.vue';
import RegisterView from './views/RegisterView.vue';

const routes = [
  {
    path: '/login',
    name: 'login',
    component: LoginView
  },
  {
    path: '/register',
    name: 'register',
    component: RegisterView
  },
  {
    path: '/',
    name: 'dashboard',
    component: DashboardView,
    meta: { requiresAuth: true },
  },
  {
    path: '/product',
    name: 'product',
    component: ProductView,
    meta: { requiresAuth: true },
  },
  {
    path: '/user',
    name: 'user',
    component: UserView,
    meta: { requiresAuth: true },
  },
  {
    path: '/categorie',
    name: 'categorie',
    component: CategorieView,
    meta: { requiresAuth: true },
  },
  {
    path: '/order',
    name: 'order',
    component: OrderView,
    meta: { requiresAuth: true },
  }
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

router.beforeEach((to, from, next) => {
  const isAuthenticated = localStorage.getItem('token');

  if (to.matched.some(record => record.meta.requiresAuth)) {
    if (!isAuthenticated) {
      next('/login');
    } else {
      next();
    }
  } else if (to.path === '/login' || to.path === '/register') {
    if (isAuthenticated) {
      next('/');
    } else {
      next();
    }
  } else {
    next();
  }
});

export default router;

import { createRouter, createWebHistory } from 'vue-router';
import LandingPage from '../views/LandingPage.vue';
import RegistrationPage from '../views/RegistrationPage.vue';
import LoginPage from '../views/LoginPage.vue'; // Import LoginPage
import MainLayout from '../layouts/MainLayout.vue';
import MealPlannerPage from '../views/MealPlannerPage.vue';

const routes = [
  {
    path: '/',
    name: 'Landing',
    component: LandingPage,
  },
  {
    path: '/register',
    name: 'Register',
    component: RegistrationPage,
  },
  {
    path: '/login',
    name: 'Login',
    component: LoginPage,
  },
  {
    path: '/meal-planner',
    name: 'MealPlannerLayout',
    component: MainLayout,
    children: [
      {
        path: '',
        name: 'MealPlanner',
        component: MealPlannerPage,
      },
    ],
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;

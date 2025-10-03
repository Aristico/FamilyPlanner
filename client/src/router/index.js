import { createRouter, createWebHistory } from 'vue-router';
import { authStore } from '../stores/auth.js';
import LandingPage from '../views/LandingPage.vue';
import RegistrationPage from '../views/RegistrationPage.vue';
import LoginPage from '../views/LoginPage.vue';
import MainLayout from '../layouts/MainLayout.vue';
import MealPlannerPage from '../views/MealPlannerPage.vue';
import ProfilePage from '../views/ProfilePage.vue';

const routes = [
  {
    path: '/',
    name: 'Landing',
    component: LandingPage,
    meta: { requiresAuth: false },
  },
  {
    path: '/register',
    name: 'Register',
    component: RegistrationPage,
    meta: { requiresAuth: false, guestOnly: true },
  },
  {
    path: '/login',
    name: 'Login',
    component: LoginPage,
    meta: { requiresAuth: false, guestOnly: true },
  },
  {
    path: '/app',
    component: MainLayout,
    meta: { requiresAuth: true },
    children: [
      {
        path: 'meal-planner',
        name: 'MealPlanner',
        component: MealPlannerPage,
      },
      {
        path: 'profile',
        name: 'Profile',
        component: ProfilePage,
      },
      // Redirect /app to /app/meal-planner
      { path: '', redirect: '/app/meal-planner' },
    ],
  },
  // Redirect old /meal-planner path
  { path: '/meal-planner', redirect: '/app/meal-planner' },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

// A flag to ensure we only check auth status once on app load
let initialAuthCheckDone = false;

async function checkAuthentication() {
  try {
    const response = await fetch('/api/v1/endpoints/check-auth.php', { credentials: 'include' });
    if (response.ok) {
      const data = await response.json();
      if (data.isAuthenticated) {
        authStore.authenticate(data.user);
      }
    }
  } catch (error) {
    console.error('Authentication check failed:', error);
    authStore.clear();
  }
  initialAuthCheckDone = true;
}

router.beforeEach(async (to, from, next) => {
  if (!initialAuthCheckDone) {
    await checkAuthentication();
  }

  const isAuthenticated = authStore.isAuthenticated;
  const requiresAuth = to.matched.some(record => record.meta.requiresAuth);
  const guestOnly = to.matched.some(record => record.meta.guestOnly);

  if (requiresAuth && !isAuthenticated) {
    // Redirect unauthenticated users to login page
    next('/login');
  } else if (guestOnly && isAuthenticated) {
    // Redirect authenticated users away from login/register
    next('/app/meal-planner');
  } else {
    // Allow navigation
    next();
  }
});

export default router;
<template>
  <div class="flex flex-col items-center justify-center min-h-screen bg-slate-100 p-4">
    <div class="bg-white p-8 rounded-lg border border-slate-200 shadow-sm w-full max-w-md">
      <h2 class="text-2xl font-bold text-slate-900 mb-6 text-center">Login</h2>

      <form @submit.prevent="loginUser">
        <div class="mb-4">
          <label for="email" class="block text-sm font-medium text-slate-700 mb-1">E-Mail-Adresse</label>
          <input
            type="email"
            id="email"
            v-model="email"
            class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
            required
          />
        </div>

        <div class="mb-6">
          <label for="password" class="block text-sm font-medium text-slate-700 mb-1">Passwort</label>
          <input
            type="password"
            id="password"
            v-model="password"
            class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
            required
          />
        </div>

        <button
          type="submit"
          class="w-full px-4 py-2 bg-primary-600 text-white font-semibold rounded-lg shadow-sm hover:bg-primary-700"
        >
          Login
        </button>
      </form>

      <p class="mt-4 text-center text-sm text-slate-600">
        Noch kein Konto?
        <router-link to="/register" class="text-primary-600 hover:underline">Registrieren</router-link>
      </p>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';

const email = ref('');
const password = ref('');

const loginUser = () => {
  // Here you would typically send the data to your backend API
  console.log('Logging in user:', email.value, password.value);
  alert('Login erfolgreich (simuliert)!');
  // Optionally redirect to dashboard
};
</script>

<style scoped>
/* No scoped styles needed as Tailwind handles most of it */
</style>

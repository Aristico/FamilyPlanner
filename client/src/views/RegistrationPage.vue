<template>
  <div class="flex flex-col items-center justify-center min-h-screen bg-slate-100 p-4">
    <div class="bg-white p-8 rounded-lg border border-slate-200 shadow-sm w-full max-w-md">
      <h2 class="text-2xl font-bold text-slate-900 mb-6 text-center">Registrieren</h2>

      <form @submit.prevent="registerUser">
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

        <div class="mb-4">
          <label for="password" class="block text-sm font-medium text-slate-700 mb-1">Passwort</label>
          <input
            type="password"
            id="password"
            v-model="password"
            class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
            required
          />
        </div>

        <div class="mb-6">
          <label for="confirmPassword" class="block text-sm font-medium text-slate-700 mb-1">Passwort bestätigen</label>
          <input
            type="password"
            id="confirmPassword"
            v-model="confirmPassword"
            class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
            required
          />
        </div>

        <button
          type="submit"
          class="w-full px-4 py-2 bg-primary-600 text-white font-semibold rounded-lg shadow-sm hover:bg-primary-700"
        >
          Registrieren
        </button>
      </form>

      <p class="mt-4 text-center text-sm text-slate-600">
        Bereits registriert?
        <router-link to="/login" class="text-primary-600 hover:underline">Login</router-link>
      </p>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';

const email = ref('');
const password = ref('');
const confirmPassword = ref('');

const registerUser = () => {
  if (password.value !== confirmPassword.value) {
    alert('Passwörter stimmen nicht überein!');
    return;
  }
  // Here you would typically send the data to your backend API
  console.log('Registering user:', email.value, password.value);
  alert('Registrierung erfolgreich (simuliert)!');
  // Optionally redirect to login or dashboard
};
</script>

<style scoped>
/* No scoped styles needed as Tailwind handles most of it */
</style>

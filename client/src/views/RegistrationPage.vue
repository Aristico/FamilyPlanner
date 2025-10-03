<template>
  <div class="min-h-screen flex items-center justify-center bg-slate-100">
    <div class="max-w-md w-full bg-white p-8 rounded-lg shadow-lg">
      <div class="text-center mb-8">
        <i class="ph ph-calendar-check text-primary-600 text-5xl"></i>
        <h1 class="mt-2 text-2xl font-bold text-slate-900">Account erstellen</h1>
        <p class="text-slate-500">Erstelle einen Account, um deinen Familienplaner zu starten.</p>
      </div>

      <form @submit.prevent="handleRegister">
        <div v-if="message" class="mb-4 p-3 rounded-lg text-center" :class="isError ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800'">
          {{ message }}
        </div>

        <div class="space-y-4">
          <div>
            <label for="name" class="block text-sm font-medium text-slate-700 mb-1">Name</label>
            <input v-model="name" type="text" id="name" required class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
          </div>
          <div>
            <label for="email" class="block text-sm font-medium text-slate-700 mb-1">E-Mail-Adresse</label>
            <input v-model="email" type="email" id="email" required class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
          </div>
          <div>
            <label for="password" class="block text-sm font-medium text-slate-700 mb-1">Passwort</label>
            <input v-model="password" type="password" id="password" required class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
          </div>
        </div>

        <div class="mt-6">
          <button type="submit" :disabled="isLoading" class="w-full px-4 py-2.5 bg-primary-600 text-white font-semibold rounded-lg shadow-sm hover:bg-primary-700 disabled:bg-primary-400 disabled:cursor-not-allowed">
            <span v-if="isLoading">Registriere...</span>
            <span v-else>Registrieren</span>
          </button>
        </div>
      </form>

      <div class="mt-6 text-center">
        <p class="text-sm text-slate-600">
          Du hast bereits einen Account?
          <router-link to="/login" class="font-medium text-primary-600 hover:text-primary-700">Hier einloggen</router-link>
        </p>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';

const name = ref('');
const email = ref('');
const password = ref('');
const message = ref('');
const isError = ref(false);
const isLoading = ref(false);
const router = useRouter();

const handleRegister = async () => {
  isLoading.value = true;
  isError.value = false;
  message.value = '';

  try {
    const response = await fetch('/api/v1/endpoints/register.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({
        name: name.value,
        email: email.value,
        password: password.value,
      }),
    });

    const result = await response.json();

    if (!response.ok) {
      isError.value = true;
      throw new Error(result.message || 'Ein Fehler ist aufgetreten.');
    }

    message.value = result.message;
    // Redirect to login after a short delay
    setTimeout(() => {
      router.push('/login');
    }, 2000);

  } catch (error) {
    isError.value = true;
    message.value = error.message;
  } finally {
    isLoading.value = false;
  }
};
</script>
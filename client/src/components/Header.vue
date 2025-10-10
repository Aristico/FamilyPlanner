<template>
  <header class="bg-white/80 backdrop-blur-sm border-b-2 border-slate-300 shadow-md z-10">
    <div class="px-4 sm:px-6 lg:px-8 relative h-16 flex items-center justify-center">
      <!-- Logo (Center) -->
      <div class="flex items-center">
        <i class="ph ph-calendar-check text-primary-600 text-2xl"></i>
        <h1 class="ml-2 text-lg font-bold text-slate-900">FamilienPlaner</h1>
      </div>

      <!-- Profile Picture (Right) -->
      <div class="absolute right-4 top-1/2 -translate-y-1/2">
        <router-link to="/app/profile">
          <img v-if="authStore.user && authStore.user.avatar_url" :src="authStore.user.avatar_url" alt="Benutzerbild" class="w-10 h-10 rounded-full object-cover" />
          <!-- Placeholder with initial -->
          <div v-else-if="authStore.user" class="w-10 h-10 rounded-full bg-primary-600 flex items-center justify-center text-white font-bold text-lg">
            {{ authStore.user.name.charAt(0).toUpperCase() }}
          </div>
        </router-link>
      </div>
    </div>
  </header>
</template>

<script setup>
import { authStore } from '../stores/auth.js';
</script>

<style scoped>
/* No scoped styles needed as Tailwind handles most of it */
</style>
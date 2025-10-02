<template>
  <nav class="absolute top-0 left-0 right-0 bg-transparent p-4 z-10">
    <div class="container mx-auto flex justify-between items-center">
      <div class="flex items-center">
        <i class="ph ph-calendar-check text-primary-600 text-3xl"></i>
        <h1 class="ml-2 text-xl font-bold text-slate-900">FamilienPlaner</h1>
      </div>
      <div class="flex gap-4">
        <router-link to="/login" class="px-4 py-2 text-slate-700 font-semibold rounded-lg hover:bg-slate-100">Login</router-link>
        <router-link to="/register" class="px-4 py-2 bg-primary-600 text-white font-semibold rounded-lg shadow-sm hover:bg-primary-700">Registrieren</router-link>
      </div>
    </div>
  </nav>
</template>

<script setup>
// No script needed for this simple TopNav
</script>

<style scoped>
/* No scoped styles needed as Tailwind handles most of it */
</style>

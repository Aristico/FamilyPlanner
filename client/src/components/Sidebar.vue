<template>
  <aside class="hidden md:flex flex-col w-64 bg-white border-r border-slate-200">
    <div class="flex items-center justify-center h-16 border-b border-slate-200">
      <i class="ph ph-calendar-check text-primary-600 text-3xl"></i>
      <h1 class="ml-2 text-xl font-bold text-slate-900">FamilienPlaner</h1>
    </div>
    <nav class="flex-1 px-4 py-4 space-y-2">
      <router-link to="/meal-planner" class="flex items-center px-4 py-2 text-white bg-primary-600 rounded-lg shadow-sm">
        <i class="ph-fill ph-fork-knife text-lg"></i>
        <span class="ml-3 font-medium">Essensplaner</span>
      </router-link>
      <a href="#" class="flex items-center px-4 py-2 text-slate-700 hover:bg-slate-100 rounded-lg opacity-50 pointer-events-none">
        <i class="ph ph-books text-lg"></i>
        <span class="ml-3 font-medium">Rezeptkatalog</span>
      </a>
      <a href="#" class="flex items-center px-4 py-2 text-slate-700 hover:bg-slate-100 rounded-lg opacity-50 pointer-events-none">
        <i class="ph ph-popcorn text-lg"></i>
        <span class="ml-3 font-medium">Serien-Tracker</span>
      </a>
      <a href="#" class="flex items-center px-4 py-2 text-slate-700 hover:bg-slate-100 rounded-lg opacity-50 pointer-events-none">
        <i class="ph ph-bank text-lg"></i>
        <span class="ml-3 font-medium">Haushaltsbuch</span>
      </a>
    </nav>
    <div class="px-4 py-4 border-t border-slate-200">
      <a href="#" class="flex items-center px-4 py-2 text-slate-700 hover:bg-slate-100 rounded-lg opacity-50 pointer-events-none">
        <img src="https://placehold.co/40x40/6366f1/FFFFFF?text=M" alt="Benutzerbild" class="w-8 h-8 rounded-full" />
        <span class="ml-3 font-medium">Max Mustermann</span>
      </a>
    </div>
  </aside>
</template>

<script setup>
// No script needed for this simple Sidebar
</script>

<style scoped>
/* No scoped styles needed as Tailwind handles most of it */
</style>

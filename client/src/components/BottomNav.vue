<template>
  <nav class="md:hidden fixed bottom-0 left-0 right-0 bg-white border-t border-slate-200 flex justify-around h-16 shadow-[0_-1px_3px_rgba(0,0,0,0.05)]">
    <router-link to="/meal-planner" class="flex flex-col items-center justify-center text-primary-600 w-full">
      <i class="ph-fill ph-fork-knife text-2xl"></i>
      <span class="text-xs font-medium">Planer</span>
    </router-link>
    <a href="#" class="flex flex-col items-center justify-center text-slate-600 w-full opacity-50 pointer-events-none">
      <i class="ph ph-books text-2xl"></i>
      <span class="text-xs">Rezepte</span>
    </a>
    <a href="#" class="flex flex-col items-center justify-center text-slate-600 w-full opacity-50 pointer-events-none">
      <i class="ph ph-popcorn text-2xl"></i>
      <span class="text-xs">Serien</span>
    </a>
    <a href="#" class="flex flex-col items-center justify-center text-slate-600 w-full opacity-50 pointer-events-none">
      <i class="ph ph-bank text-2xl"></i>
      <span class="text-xs">Budget</span>
    </a>
    <a href="#" class="flex flex-col items-center justify-center text-slate-600 w-full opacity-50 pointer-events-none">
      <i class="ph ph-user-circle text-2xl"></i>
      <span class="text-xs">Profil</span>
    </a>
  </nav>
</template>

<script setup>
// No script needed for this simple BottomNav
</script>

<style scoped>
/* No scoped styles needed as Tailwind handles most of it */
</style>

<template>
  <header class="bg-white/80 backdrop-blur-sm border-b border-slate-200 z-10">
    <div class="px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-16">
        <div class="md:hidden">
          <h1 class="text-xl font-bold text-slate-900">Essensplaner</h1>
        </div>
        <div class="flex items-center justify-center flex-1">
          <button class="p-2 rounded-full hover:bg-slate-200">
            <i class="ph ph-caret-left text-xl"></i>
          </button>
          <h2 class="mx-4 text-lg font-semibold text-slate-800">Woche 40 (30. Sep - 06. Okt)</h2>
          <button class="p-2 rounded-full hover:bg-slate-200">
            <i class="ph ph-caret-right text-xl"></i>
          </button>
        </div>
      </div>
    </div>
  </header>
</template>

<script setup>
// No script needed for this simple Header
</script>

<style scoped>
/* No scoped styles needed as Tailwind handles most of it */
</style>

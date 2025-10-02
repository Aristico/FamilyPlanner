<template>
  <div class="flex h-screen bg-slate-100 text-slate-900">
    <!-- Sidebar (Desktop) -->
    <Sidebar />

    <!-- Main Content -->
    <main class="flex-1 flex flex-col overflow-hidden pb-16 md:pb-0">
      <!-- Header -->
      <Header />

      <!-- Scrollable Content Area -->
      <div class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8">
        <router-view />
      </div>

      <!-- Floating Action Button -->
      <button class="absolute bottom-24 right-4 md:bottom-6 md:right-6 w-14 h-14 bg-primary-600 text-white rounded-full flex items-center justify-center shadow-lg hover:bg-primary-700 transition-transform hover:scale-110">
        <i class="ph ph-plus text-3xl"></i>
      </button>
    </main>

    <!-- Bottom Navigation (Mobile) -->
    <BottomNav />
  </div>
</template>

<script setup>
import Sidebar from '../components/Sidebar.vue';
import Header from '../components/Header.vue';
import BottomNav from '../components/BottomNav.vue';
</script>

<style scoped>
/* No scoped styles needed as Tailwind handles most of it */
</style>

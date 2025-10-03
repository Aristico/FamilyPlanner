<template>
  <div class="flex h-screen bg-slate-100 text-slate-900">
    <!-- Sidebar (Desktop) -->
    <Sidebar :isOpen="isSidebarOpen" @close="isSidebarOpen = false" />

    <!-- Main Content -->
    <main class="flex-1 flex flex-col overflow-hidden transition-all duration-300">
      <!-- Header -->
      <Header />

      <!-- Scrollable Content Area -->
      <div class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8">
        <router-view />
      </div>
    </main>

    <!-- Close Sidebar Button -->
    <transition
      enter-active-class="transition-opacity duration-150"
      leave-active-class="transition-opacity duration-150"
      enter-from-class="opacity-0"
      leave-to-class="opacity-0"
      mode="out-in"
    >
      <button @click="toggleSidebar" class="fixed z-50 top-2.5 left-4 p-2 rounded-full text-slate-900">
        <i v-if="isSidebarOpen" class="ph ph-x text-2xl"></i>
        <i v-else class="ph ph-list text-2xl"></i>
      </button>
    </transition>

    <!-- Floating Action Button -->
    <button class="fixed z-30 bottom-6 right-6 w-14 h-14 bg-primary-600 text-white rounded-full flex items-center justify-center shadow-md hover:bg-primary-700 transition-transform hover:scale-110">
      <i class="ph ph-plus text-3xl"></i>
    </button>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import Sidebar from '../components/Sidebar.vue';
import Header from '../components/Header.vue';

const isSidebarOpen = ref(false);

const toggleSidebar = () => {
  isSidebarOpen.value = !isSidebarOpen.value;
};
</script>

<style scoped>
/* No scoped styles needed as Tailwind handles most of it */
</style>

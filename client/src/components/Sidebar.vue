<template>
  <div class="h-full">
    <!-- Backdrop -->
    <div v-if="isOpen" @click="$emit('close')" class="fixed inset-0 bg-slate-900/50 z-30"></div>

    <!-- Sidebar -->
    <aside
      class="fixed inset-y-0 left-0 z-40 w-64 bg-white border-r border-slate-200 transform transition-transform flex flex-col h-full"
      :class="isOpen ? 'translate-x-0' : '-translate-x-full'"
    >
      <div class="flex items-center justify-end h-16 border-b border-slate-200 px-4">
        <button @click="handleLogout" class="p-2 rounded-full hover:bg-slate-200">
          <i class="ph ph-sign-out text-2xl text-slate-600"></i>
        </button>
      </div>
      <nav class="flex-1 px-4 py-4 space-y-2">
        <router-link to="/app/meal-planner" v-slot="{ isActive }" @click="$emit('close')">
          <a href="#" class="flex items-center px-4 py-2 rounded-lg transition-colors"
            :class="isActive ? 'bg-primary-600 text-white shadow-sm' : 'text-slate-700 hover:bg-slate-100'">
            <i class="ph-fill ph-fork-knife text-lg"></i>
            <span class="ml-3 font-medium">Wochenplan</span>
          </a>
        </router-link>
      </nav>
      <div class="px-4 py-4 border-t border-slate-200">
        <router-link to="/app/profile" v-slot="{ isActive }" @click="$emit('close')">
          <a href="#" class="flex items-center px-4 py-2 rounded-lg transition-colors"
            :class="isActive ? 'bg-primary-600 text-white shadow-sm' : 'text-slate-700 hover:bg-slate-100'">
                        <img v-if="authStore.user && authStore.user.avatar_url" :src="authStore.user.avatar_url" alt="Benutzerbild" class="w-8 h-8 rounded-full object-cover" />
            <div v-else-if="authStore.user" class="w-8 h-8 rounded-full bg-primary-600 flex items-center justify-center text-white font-bold text-sm">
              {{ authStore.user.name.charAt(0).toUpperCase() }}
            </div>
            <span class="ml-3 font-medium">Profil</span>
          </a>
        </router-link>
      </div>
    </aside>
  </div>
</template>

<script setup>
import { useRouter } from 'vue-router';
import { authStore } from '../stores/auth.js';

defineProps({
  isOpen: Boolean,
});

defineEmits(['close']);

const router = useRouter();

const handleLogout = async () => {
  try {
    const response = await fetch('/api/v1/endpoints/logout.php', {
      method: 'POST',
      credentials: 'include',
    });

    if (response.ok) {
      authStore.clear();
      router.push('/login');
    } else {
      throw new Error('Logout failed');
    }
  } catch (error) {
    console.error('Logout error:', error);
    // Optionally, show an error message to the user
  }
};
</script>

<style scoped>
/* No scoped styles needed as Tailwind handles most of it */
</style>

<template>
  <div>
    <!-- Control Bar -->
    <div class="relative flex items-center justify-center mb-4 md:mb-6 h-10">
      <!-- Week Nav -->
      <div class="flex items-center justify-center">
        <button class="p-2 rounded-full hover:bg-slate-200">
          <i class="ph ph-caret-left text-xl"></i>
        </button>
        <h2 class="mx-4 text-lg font-semibold text-slate-800">Woche 40 (30. Sep - 06. Okt)</h2>
        <button class="p-2 rounded-full hover:bg-slate-200">
          <i class="ph ph-caret-right text-xl"></i>
        </button>
      </div>

      <!-- Layout Switcher -->
      <div class="hidden md:flex items-center space-x-1 bg-slate-200 p-1 rounded-lg absolute right-0">
        <button @click="setColumns(1)" class="p-1.5 rounded-md transition-colors" :class="columns === 1 ? 'bg-slate-400' : 'hover:bg-slate-300'">
          <div class="w-5 h-4 rounded-sm" :class="columns === 1 ? 'bg-white' : 'bg-slate-400'"></div>
        </button>
        <button @click="setColumns(2)" class="p-1.5 rounded-md transition-colors" :class="columns === 2 ? 'bg-slate-400' : 'hover:bg-slate-300'">
          <div class="flex items-center justify-center space-x-0.5 w-5 h-4">
            <div class="w-1/2 h-full rounded-sm" :class="columns === 2 ? 'bg-white' : 'bg-slate-400'"></div>
            <div class="w-1/2 h-full rounded-sm" :class="columns === 2 ? 'bg-white' : 'bg-slate-400'"></div>
          </div>
        </button>
        <button @click="setColumns(3)" class="p-1.5 rounded-md transition-colors" :class="columns === 3 ? 'bg-slate-400' : 'hover:bg-slate-300'">
          <div class="flex items-center justify-center space-x-0.5 w-5 h-4">
            <div class="w-1/3 h-full rounded-sm" :class="columns === 3 ? 'bg-white' : 'bg-slate-400'"></div>
            <div class="w-1/3 h-full rounded-sm" :class="columns === 3 ? 'bg-white' : 'bg-slate-400'"></div>
            <div class="w-1/3 h-full rounded-sm" :class="columns === 3 ? 'bg-white' : 'bg-slate-400'"></div>
          </div>
        </button>
      </div>
    </div>

    <div class="grid grid-cols-1 gap-4" :class="`md:grid-cols-${columns}`">
      <!-- Loop through days -->
      <div v-for="dayData in weekData" :key="dayData.day" class="bg-white rounded-lg border-2 border-slate-300 shadow-md p-4 flex flex-col">
        <div class="flex justify-between items-center mb-3">
          <h3 class="font-bold text-slate-800">{{ dayData.day }}</h3>
          <button class="p-2 rounded-full hover:bg-slate-100">
            <i class="ph ph-storefront text-xl text-slate-500"></i>
          </button>
        </div>
        <div class="space-y-4 flex-1">
          <MealSlot title="Frühstück" :meal="dayData.meals.breakfast" />
          <MealSlot title="Mittagessen" :meal="dayData.meals.lunch" />
          <MealSlot title="Abendessen" :meal="dayData.meals.dinner" />
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import MealSlot from '../components/MealSlot.vue';

const columns = ref(3);

const setColumns = (count) => {
  columns.value = count;
};

// Sample data structure
const weekData = ref([
  {
    day: 'Montag',
    meals: {
      breakfast: { name: 'Müsli & Joghurt', servings: '2 Pers.', icon: 'ph-users', colorClass: 'bg-sky-100 border-sky-500 text-sky-900' },
      lunch: { name: 'Außer Haus', servings: '1 Pers.', icon: 'ph-storefront', colorClass: 'bg-amber-100 border-amber-500 text-amber-900' },
      dinner: { name: 'Spaghetti Bolognese', servings: '4 Pers.', icon: 'ph-users', colorClass: 'bg-emerald-100 border-emerald-500 text-emerald-900' },
    }
  },
  {
    day: 'Dienstag',
    meals: {
      breakfast: null,
      lunch: null,
      dinner: { name: 'Hähnchen Curry', servings: '4 Pers.', icon: 'ph-users', colorClass: 'bg-emerald-100 border-emerald-500 text-emerald-900' },
    }
  },
  { day: 'Mittwoch', meals: { breakfast: null, lunch: null, dinner: null } },
  { day: 'Donnerstag', meals: { breakfast: null, lunch: null, dinner: null } },
  { day: 'Freitag', meals: { breakfast: null, lunch: null, dinner: null } },
  { day: 'Samstag', meals: { breakfast: null, lunch: null, dinner: null } },
  { day: 'Sonntag', meals: { breakfast: null, lunch: null, dinner: null } },
]);
</script>

<style scoped>
/* No scoped styles needed as Tailwind handles most of it */
</style>

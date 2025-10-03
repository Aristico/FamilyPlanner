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
      <!-- Montag -->
      <div class="bg-white rounded-lg border-2 border-slate-300 shadow-md p-4 flex flex-col">
        <div class="flex justify-between items-center mb-3">
          <h3 class="font-bold text-slate-800">Montag</h3>
          <button class="p-2 rounded-full hover:bg-slate-100">
            <i class="ph ph-storefront text-xl text-slate-500"></i>
          </button>
        </div>
        <div class="space-y-3 flex-1">
          <div class="min-h-[90px] bg-slate-50/80 p-2.5 rounded-lg space-y-1.5">
            <div class="text-xs font-semibold text-slate-500">Frühstück</div>
            <div class="bg-sky-200 text-sky-900 p-2 rounded-md">
              <p class="font-semibold text-sm">Müsli & Joghurt</p>
              <span class="text-xs flex items-center mt-1 font-medium"><i class="ph-fill ph-users mr-1"></i> 2 Pers.</span>
            </div>
          </div>
          <div class="min-h-[90px] bg-slate-50/80 p-2.5 rounded-lg space-y-1.5">
            <div class="text-xs font-semibold text-slate-500">Mittagessen</div>
            <div class="bg-amber-200 text-amber-900 p-2 rounded-md">
              <p class="font-semibold text-sm">Außer Haus</p>
              <span class="text-xs flex items-center mt-1 font-medium"><i class="ph-fill ph-storefront mr-1"></i> 1 Pers.</span>
            </div>
          </div>
          <div class="min-h-[90px] bg-slate-50/80 p-2.5 rounded-lg space-y-1.5">
            <div class="text-xs font-semibold text-slate-500">Abendessen</div>
            <div class="bg-emerald-200 text-emerald-900 p-2 rounded-md">
              <p class="font-semibold text-sm">Spaghetti Bolognese</p>
              <span class="text-xs flex items-center mt-1 font-medium"><i class="ph-fill ph-users mr-1"></i> 4 Pers.</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Other days follow the same structure -->
      <!-- Dienstag -->
      <div class="bg-white rounded-lg border-2 border-slate-300 shadow-md p-4 flex flex-col">
        <div class="flex justify-between items-center mb-3">
          <h3 class="font-bold text-slate-800">Dienstag</h3>
          <button class="p-2 rounded-full hover:bg-slate-100">
            <i class="ph ph-storefront text-xl text-slate-500"></i>
          </button>
        </div>
        <div class="space-y-3 flex-1">
          <div class="min-h-[90px] bg-slate-50/80 p-2.5 rounded-lg"></div>
          <div class="min-h-[90px] bg-slate-50/80 p-2.5 rounded-lg"></div>
          <div class="min-h-[90px] bg-slate-50/80 p-2.5 rounded-lg space-y-1.5">
            <div class="text-xs font-semibold text-slate-500">Abendessen</div>
            <div class="bg-emerald-200 text-emerald-900 p-2 rounded-md">
              <p class="font-semibold text-sm">Hähnchen Curry</p>
              <span class="text-xs flex items-center mt-1 font-medium"><i class="ph-fill ph-users mr-1"></i> 4 Pers.</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Mittwoch -->
      <div class="bg-white rounded-lg border-2 border-slate-300 shadow-md p-4 flex flex-col">
        <div class="flex justify-between items-center mb-3">
          <h3 class="font-bold text-slate-800">Mittwoch</h3>
          <button class="p-2 rounded-full hover:bg-slate-100">
            <i class="ph ph-storefront text-xl text-slate-500"></i>
          </button>
        </div>
        <div class="space-y-3 flex-1">
          <div class="min-h-[90px] bg-slate-50/80 p-2.5 rounded-lg"></div>
          <div class="min-h-[90px] bg-slate-50/80 p-2.5 rounded-lg"></div>
          <div class="min-h-[90px] bg-slate-50/80 p-2.5 rounded-lg"></div>
        </div>
      </div>

      <!-- Donnerstag -->
      <div class="bg-white rounded-lg border-2 border-slate-300 shadow-md p-4 flex flex-col">
        <div class="flex justify-between items-center mb-3">
          <h3 class="font-bold text-slate-800">Donnerstag</h3>
          <button class="p-2 rounded-full hover:bg-slate-100">
            <i class="ph ph-storefront text-xl text-slate-500"></i>
          </button>
        </div>
        <div class="space-y-3 flex-1">
          <div class="min-h-[90px] bg-slate-50/80 p-2.5 rounded-lg"></div>
          <div class="min-h-[90px] bg-slate-50/80 p-2.5 rounded-lg"></div>
          <div class="min-h-[90px] bg-slate-50/80 p-2.5 rounded-lg"></div>
        </div>
      </div>

      <!-- Freitag -->
      <div class="bg-white rounded-lg border-2 border-slate-300 shadow-md p-4 flex flex-col">
        <div class="flex justify-between items-center mb-3">
          <h3 class="font-bold text-slate-800">Freitag</h3>
          <button class="p-2 rounded-full hover:bg-slate-100">
            <i class="ph ph-storefront text-xl text-slate-500"></i>
          </button>
        </div>
        <div class="space-y-3 flex-1">
          <div class="min-h-[90px] bg-slate-50/80 p-2.5 rounded-lg"></div>
          <div class="min-h-[90px] bg-slate-50/80 p-2.5 rounded-lg"></div>
          <div class="min-h-[90px] bg-slate-50/80 p-2.5 rounded-lg"></div>
        </div>
      </div>

      <!-- Samstag -->
      <div class="bg-white rounded-lg border-2 border-slate-300 shadow-md p-4 flex flex-col">
        <div class="flex justify-between items-center mb-3">
          <h3 class="font-bold text-slate-800">Samstag</h3>
          <button class="p-2 rounded-full hover:bg-slate-100">
            <i class="ph ph-storefront text-xl text-slate-500"></i>
          </button>
        </div>
        <div class="space-y-3 flex-1">
          <div class="min-h-[90px] bg-slate-50/80 p-2.5 rounded-lg"></div>
          <div class="min-h-[90px] bg-slate-50/80 p-2.5 rounded-lg"></div>
          <div class="min-h-[90px] bg-slate-50/80 p-2.5 rounded-lg"></div>
        </div>
      </div>

      <!-- Sonntag -->
      <div class="bg-white rounded-lg border-2 border-slate-300 shadow-md p-4 flex flex-col">
        <div class="flex justify-between items-center mb-3">
          <h3 class="font-bold text-slate-800">Sonntag</h3>
          <button class="p-2 rounded-full hover:bg-slate-100">
            <i class="ph ph-storefront text-xl text-slate-500"></i>
          </button>
        </div>
        <div class="space-y-3 flex-1">
          <div class="min-h-[90px] bg-slate-50/80 p-2.5 rounded-lg"></div>
          <div class="min-h-[90px] bg-slate-50/80 p-2.5 rounded-lg"></div>
          <div class="min-h-[90px] bg-slate-50/80 p-2.5 rounded-lg"></div>
        </div>
      </div>

    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';

const columns = ref(3);

const setColumns = (count) => {
  columns.value = count;
};
</script>

<style scoped>
/* No scoped styles needed as Tailwind handles most of it */
</style>
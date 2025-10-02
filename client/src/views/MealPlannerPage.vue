<template>
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2 gap-4">
    <!-- Wochentage -->
    <div class="space-y-4">
      <h3 class="font-bold text-center text-slate-700">Montag</h3>
      <div class="min-h-[100px] bg-white p-2.5 rounded-lg border border-slate-200 shadow-sm space-y-2">
        <div class="text-xs font-semibold text-slate-500">Frühstück</div>
        <div class="bg-sky-200 text-sky-900 p-2 rounded-md">
          <p class="font-semibold text-sm">Müsli & Joghurt</p>
          <span class="text-xs flex items-center mt-1 font-medium"><i class="ph-fill ph-users mr-1"></i> 2 Pers.</span>
        </div>
      </div>
      <div class="min-h-[100px] bg-white p-2.5 rounded-lg border border-slate-200 shadow-sm space-y-2">
        <div class="text-xs font-semibold text-slate-500">Mittagessen</div>
        <div class="bg-amber-200 text-amber-900 p-2 rounded-md">
          <p class="font-semibold text-sm">Außer Haus</p>
          <span class="text-xs flex items-center mt-1 font-medium"><i class="ph-fill ph-storefront mr-1"></i> 1 Pers.</span>
        </div>
      </div>
      <div class="min-h-[100px] bg-white p-2.5 rounded-lg border border-slate-200 shadow-sm space-y-2">
        <div class="text-xs font-semibold text-slate-500">Abendessen</div>
        <div class="bg-emerald-200 text-emerald-900 p-2 rounded-md">
          <p class="font-semibold text-sm">Spaghetti Bolognese</p>
          <span class="text-xs flex items-center mt-1 font-medium"><i class="ph-fill ph-users mr-1"></i> 4 Pers.</span>
        </div>
      </div>
    </div>

    <div class="space-y-4">
      <h3 class="font-bold text-center text-slate-700">Dienstag</h3>
      <div class="min-h-[100px] bg-white p-2.5 rounded-lg border border-slate-200 shadow-sm"></div>
      <div class="min-h-[100px] bg-white p-2.5 rounded-lg border border-slate-200 shadow-sm"></div>
      <div class="min-h-[100px] bg-white p-2.5 rounded-lg border border-slate-200 shadow-sm space-y-2">
        <div class="text-xs font-semibold text-slate-500">Abendessen</div>
        <div class="bg-emerald-200 text-emerald-900 p-2 rounded-md">
          <p class="font-semibold text-sm">Hähnchen Curry</p>
          <span class="text-xs flex items-center mt-1 font-medium"><i class="ph-fill ph-users mr-1"></i> 4 Pers.</span>
        </div>
      </div>
    </div>

    <!-- Leere Tage für die Demo -->
    <div class="space-y-4"><h3 class="font-bold text-center text-slate-700">Mittwoch</h3><div class="min-h-[100px] bg-white p-2.5 rounded-lg border border-slate-200 shadow-sm"></div><div class="min-h-[100px] bg-white p-2.5 rounded-lg border border-slate-200 shadow-sm"></div><div class="min-h-[100px] bg-white p-2.5 rounded-lg border border-slate-200 shadow-sm"></div></div>
    <div class="space-y-4"><h3 class="font-bold text-center text-slate-700">Donnerstag</h3><div class="min-h-[100px] bg-white p-2.5 rounded-lg border border-slate-200 shadow-sm"></div><div class="min-h-[100px] bg-white p-2.5 rounded-lg border border-slate-200 shadow-sm"></div><div class="min-h-[100px] bg-white p-2.5 rounded-lg border border-slate-200 shadow-sm"></div></div>
    <div class="space-y-4"><h3 class="font-bold text-center text-slate-700">Freitag</h3><div class="min-h-[100px] bg-white p-2.5 rounded-lg border border-slate-200 shadow-sm"></div><div class="min-h-[100px] bg-white p-2.5 rounded-lg border border-slate-200 shadow-sm"></div><div class="min-h-[100px] bg-white p-2.5 rounded-lg border border-slate-200 shadow-sm"></div></div>
    <div class="space-y-4"><h3 class="font-bold text-center text-slate-700">Samstag</h3><div class="min-h-[100px] bg-white p-2.5 rounded-lg border border-slate-200 shadow-sm"></div><div class="min-h-[100px] bg-white p-2.5 rounded-lg border border-slate-200 shadow-sm"></div><div class="min-h-[100px] bg-white p-2.5 rounded-lg border border-slate-200 shadow-sm"></div></div>
    <div class="space-y-4"><h3 class="font-bold text-center text-slate-700">Sonntag</h3><div class="min-h-[100px] bg-white p-2.5 rounded-lg border border-slate-200 shadow-sm"></div><div class="min-h-[100px] bg-white p-2.5 rounded-lg border border-slate-200 shadow-sm"></div><div class="min-h-[100px] bg-white p-2.5 rounded-lg border border-slate-200 shadow-sm"></div></div>
  </div>
</template>

<script setup>
// No script needed for this simple MealPlannerPage
</script>

<style scoped>
/* No scoped styles needed as Tailwind handles most of it */
</style>

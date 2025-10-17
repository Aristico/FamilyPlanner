<template>
  <div>
    <h4 class="text-sm font-bold text-slate-600 mb-1">{{ title }}</h4>
    <div v-if="meal" class="p-2.5 rounded-lg border-l-4" :class="meal.colorClass || 'bg-sky-100 border-sky-500 text-sky-900'">
      <p class="font-semibold text-sm">{{ meal.title }}</p>
      <span v-if="meal.num_adults || meal.num_children" class="text-xs flex items-center mt-1 font-medium">
        <i class="ph-fill mr-1" :class="meal.icon || 'ph-users'"></i>
        {{ meal.num_adults }} Erwachsene, {{ meal.num_children }} Kinder
      </span>
    </div>
    <div v-else class="min-h-[70px] rounded-lg p-2.5 border-2 border-dashed border-slate-300 flex items-center justify-center">
      <button @click="$emit('add')" class="p-2 rounded-full bg-slate-200 hover:bg-slate-300 transition-colors">
        <i class="ph ph-plus text-slate-600"></i>
      </button>
    </div>
  </div>
</template>

<script setup>

defineProps({
  title: {
    type: String,
    required: true,
  },
  meal: {
    type: Object,
    default: null,
  },
});

</script>

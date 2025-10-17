<template>
  <div v-if="show" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full" @click.self="close">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
      <div class="mt-3 text-center">
        <h3 class="text-lg leading-6 font-medium text-gray-900">{{ modalTitle }}</h3>
        <div class="mt-2 px-7 py-3">
          <div>
            <label for="meal-title" class="block text-sm font-medium text-slate-700">Titel</label>
            <input type="text" id="meal-title" v-model="meal.title" placeholder="z.B. Müsli, Brötchen, Salat, Pizza" class="mt-1 block w-full px-3 py-2 bg-white border border-slate-300 rounded-md shadow-sm placeholder-slate-400 focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm" />
          </div>
          <div class="mt-3">
            <label for="meal-description" class="block text-sm font-medium text-slate-700">Beschreibung</label>
            <textarea id="meal-description" v-model="meal.description" :placeholder="descriptionPlaceholder" class="mt-1 block w-full px-3 py-2 bg-white border border-slate-300 rounded-md shadow-sm placeholder-slate-400 focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm"></textarea>
          </div>
          <div class="grid grid-cols-2 gap-4 mt-3">
            <div>
              <label class="block text-sm font-medium text-slate-600">Anzahl Erwachsene</label>
              <div class="flex items-center mt-1">
                <button type="button" @click="meal.num_adults > 0 && meal.num_adults--" class="px-3 py-1 border border-slate-300 rounded-l-md hover:bg-slate-100">-</button>
                <input type="text" :value="meal.num_adults" readonly class="w-12 text-center border-t border-b border-slate-300" />
                <button type="button" @click="meal.num_adults++" class="px-3 py-1 border border-slate-300 rounded-r-md hover:bg-slate-100">+</button>
              </div>
            </div>
            <div>
              <label class="block text-sm font-medium text-slate-600">Anzahl Kinder</label>
              <div class="flex items-center mt-1">
                <button type="button" @click="meal.num_children > 0 && meal.num_children--" class="px-3 py-1 border border-slate-300 rounded-l-md hover:bg-slate-100">-</button>
                <input type="text" :value="meal.num_children" readonly class="w-12 text-center border-t border-b border-slate-300" />
                <button type="button" @click="meal.num_children++" class="px-3 py-1 border border-slate-300 rounded-r-md hover:bg-slate-100">+</button>
              </div>
            </div>
          </div>
        </div>
        <div class="items-center px-4 py-3">
          <button @click="save" class="px-4 py-2 bg-green-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-300">
            Speichern
          </button>
          <button @click="close" class="mt-3 px-4 py-2 bg-gray-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-300">
            Abbrechen
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, defineProps, defineEmits, watch, computed } from 'vue';

const props = defineProps({
  show: Boolean,
  date: String,
  mealType: String,
  preferences: Object,
});

const emits = defineEmits(['close', 'save']);

const meal = ref({
  title: '',
  description: '',
  num_adults: 0,
  num_children: 0,
});

const modalTitle = computed(() => {
  switch (props.mealType) {
    case 'breakfast':
      return 'Frühstück hinzufügen';
    case 'lunch':
      return 'Mittagessen hinzufügen';
    case 'dinner':
      return 'Abendessen hinzufügen';
    default:
      return 'Mahlzeit hinzufügen';
  }
});

const descriptionPlaceholder = computed(() => {
  switch (props.mealType) {
    case 'breakfast':
      return 'z.B. Skyr mit Müsli und gefrorenen Beeren';
    case 'lunch':
      return 'z.B. Salat mit Hähnchenbrust und Dressing';
    case 'dinner':
    default:
      return 'z.B. Spaghetti Bolognese mit frischem Parmesan';
  }
});

watch(() => props.show, (newVal) => {
  if (newVal) {
    meal.value = {
      title: '',
      description: '',
      num_adults: props.preferences?.num_adults || 0,
      num_children: props.preferences?.num_children || 0,
    };
  }
});

const close = () => {
  emits('close');
};

const save = () => {
  emits('save', {
    ...meal.value,
    date: props.date,
    meal_type: props.mealType,
  });
};
</script>

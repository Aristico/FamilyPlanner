<template>
  <div>
    <!-- Control Bar -->
    <div class="relative flex items-center justify-center mb-4 md:mb-6 h-10">
      <!-- Week Nav -->
      <div class="flex items-center justify-center">
        <button @click="previousWeek" class="p-2 rounded-full hover:bg-slate-200">
          <i class="ph ph-caret-left text-xl"></i>
        </button>
        <h2 class="mx-4 text-lg font-semibold text-slate-800">{{ weekTitle }}</h2>
        <button @click="nextWeek" class="p-2 rounded-full hover:bg-slate-200">
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
      <div v-for="(dayData, index) in weekData" :key="dayData.day" class="bg-white rounded-lg border-2 border-slate-300 shadow-md p-4 flex flex-col">
        <div class="flex justify-between items-center mb-3">
          <h3 class="font-bold text-slate-800">{{ dayData.day }}</h3>
          <button class="p-2 rounded-full hover:bg-slate-100">
            <i class="ph ph-storefront text-xl text-slate-500"></i>
          </button>
        </div>
        <div class="space-y-4 flex-1">
          <MealSlot title="Frühstück" :meal="dayData.meals.breakfast" @add="openAddMealModal(index, 'breakfast')" />
          <MealSlot title="Mittagessen" :meal="dayData.meals.lunch" @add="openAddMealModal(index, 'lunch')" />
          <MealSlot title="Abendessen" :meal="dayData.meals.dinner" @add="openAddMealModal(index, 'dinner')" />
        </div>
      </div>
    </div>
    <AddMealModal :show="isModalOpen" :date="modalDate" :mealType="modalMealType" :preferences="familyPreferences" @close="isModalOpen = false" @save="saveMeal" />
  </div>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue';
import MealSlot from '../components/MealSlot.vue';
import AddMealModal from '../components/AddMealModal.vue';
import axios from 'axios';

const columns = ref(3);
const currentDate = ref(new Date());
const weekData = ref([]);
const isModalOpen = ref(false);
const modalDate = ref('');
const modalMealType = ref('');
const familyPreferences = ref({ num_adults: 0, num_children: 0 });

const setColumns = (count) => {
  columns.value = count;
};

const getWeekInfo = (date) => {
  const current = new Date(date);
  current.setHours(0, 0, 0, 0);
  const day = current.getDay();
  const weekStart = new Date(current.setDate(current.getDate() - day + (day === 0 ? -6 : 1)));
  const weekEnd = new Date(new Date(weekStart).setDate(weekStart.getDate() + 6));
  
  const weekNumber = Math.ceil((((weekStart - new Date(weekStart.getFullYear(), 0, 1)) / 86400000) + 1) / 7);

  return {
    start: weekStart,
    end: weekEnd,
    weekNumber,
  };
};

const weekInfo = computed(() => getWeekInfo(currentDate.value));

const weekTitle = computed(() => {
  const start = weekInfo.value.start;
  const end = weekInfo.value.end;
  const startDay = start.toLocaleDateString('de-DE', { day: '2-digit' });
  const startMonth = start.toLocaleDateString('de-DE', { month: 'short' });
  const endDay = end.toLocaleDateString('de-DE', { day: '2-digit' });
  const endMonth = end.toLocaleDateString('de-DE', { month: 'short' });
  return `Woche ${weekInfo.value.weekNumber} (${startDay}. ${startMonth} - ${endDay}. ${endMonth})`;
});

const fetchMealPlan = async () => {
  const { start, end } = weekInfo.value;
  const startDate = start.toISOString().slice(0, 10);
  const endDate = end.toISOString().slice(0, 10);

  try {
    const response = await axios.get(`/api/v1/endpoints/meal-plan/get-week.php?start_date=${startDate}&end_date=${endDate}`);
    const mealPlan = response.data;
    
    const days = ['Montag', 'Dienstag', 'Mittwoch', 'Donnerstag', 'Freitag', 'Samstag', 'Sonntag'];
    const newWeekData = days.map((day, index) => {
      const date = new Date(start);
      date.setDate(start.getDate() + index);
      const dateString = date.toISOString().slice(0, 10);

      const mealsForDay = mealPlan.filter(meal => meal.date === dateString);
      
      return {
        day,
        meals: {
          breakfast: mealsForDay.find(m => m.meal_type === 'breakfast') || null,
          lunch: mealsForDay.find(m => m.meal_type === 'lunch') || null,
          dinner: mealsForDay.find(m => m.meal_type === 'dinner') || null,
        }
      };
    });
    weekData.value = newWeekData;
  } catch (error) {
    console.error('Failed to fetch meal plan:', error);
    // Reset weekData in case of an error
    weekData.value = ['Montag', 'Dienstag', 'Mittwoch', 'Donnerstag', 'Freitag', 'Samstag', 'Sonntag'].map(day => ({
      day,
      meals: { breakfast: null, lunch: null, dinner: null }
    }));
  }
};

const fetchFamilyPreferences = async () => {
  try {
    const response = await axios.get('/api/v1/endpoints/family/get-preferences.php');
    familyPreferences.value = response.data;
  } catch (error) {
    console.error('Failed to fetch family preferences:', error);
  }
};

const previousWeek = () => {
  currentDate.value = new Date(currentDate.value.setDate(currentDate.value.getDate() - 7));
  fetchMealPlan();
};

const nextWeek = () => {
  currentDate.value = new Date(currentDate.value.setDate(currentDate.value.getDate() + 7));
  fetchMealPlan();
};

const openAddMealModal = (dayIndex, mealType) => {
  const date = new Date(weekInfo.value.start);
  date.setDate(date.getDate() + dayIndex);
  modalDate.value = date.toISOString().slice(0, 10);
  modalMealType.value = mealType;
  isModalOpen.value = true;
};

const saveMeal = async (mealData) => {
  try {
    await axios.post('/api/v1/endpoints/meal-plan/create-entry.php', mealData);
    isModalOpen.value = false;
    fetchMealPlan();
  } catch (error) {
    console.error('Failed to save meal:', error);
  }
};

onMounted(() => {
  fetchMealPlan();
  fetchFamilyPreferences();
});

</script>

<style scoped>
/* No scoped styles needed as Tailwind handles most of it */
</style>

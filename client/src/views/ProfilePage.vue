<template>
  <div>
    <h1 class="text-2xl font-bold text-slate-900 mb-6">Profil</h1>

    <!-- Profile Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

      <!-- Profile Picture Card -->
      <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-lg font-semibold text-slate-800 mb-4">Profilbild</h2>
        <div class="flex flex-col items-center">
          <div class="w-40 h-40 rounded-full overflow-hidden bg-slate-200 mb-4">
            <img v-if="authStore.user && authStore.user.avatar_url" :src="authStore.user.avatar_url" alt="Profilbild" class="w-full h-full object-cover" />
            <div v-else-if="authStore.user" class="w-full h-full flex items-center justify-center bg-primary-600 text-white font-bold text-6xl">
              {{ authStore.user.name.charAt(0).toUpperCase() }}
            </div>
          </div>
          <input type="file" @change="onFileChange" accept="image/*" ref="fileInput" class="hidden" />
          <div class="flex items-center">
            <button @click="openFileInput" class="text-sm text-primary-600 hover:text-primary-700 font-semibold">
              Bild ändern
            </button>
            <button v-if="authStore.user && authStore.user.avatar_url" @click="deleteAvatar" class="text-sm text-red-600 hover:text-red-700 font-semibold ml-4">
              Bild löschen
            </button>
          </div>
        </div>

        <!-- Cropper Modal -->
        <div v-if="imageToCrop" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
          <div class="bg-white p-8 rounded-lg shadow-2xl max-w-lg w-full">
            <h3 class="text-xl font-semibold mb-4">Bild zuschneiden</h3>
            <div class="h-80">
              <vue-cropper
                ref="cropper"
                :src="imageToCrop"
                :aspect-ratio="1"
                :view-mode="1"
                drag-mode="move"
                :auto-crop-area="0.8"
                :movable="true"
                :zoomable="true"
                :scalable="true"
                style="width: 100%; height: 100%;"
              ></vue-cropper>
            </div>
            <div class="flex justify-end space-x-4 mt-6">
              <button @click="imageToCrop = null" class="px-4 py-2 rounded-md text-slate-700 bg-slate-200 hover:bg-slate-300 font-semibold">
                Abbrechen
              </button>
              <button @click="cropAndUpload" class="px-4 py-2 rounded-md text-white bg-primary-600 hover:bg-primary-700 font-semibold">
                Speichern
              </button>
            </div>
          </div>
        </div>
      </div>

      <!-- Personal Information Card -->
      <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-lg font-semibold text-slate-800 mb-4">Persönliche Informationen</h2>
        <form @submit.prevent="updateProfile">
          <div class="space-y-4">
            <div>
              <label for="name" class="block text-sm font-medium text-slate-700">Name</label>
              <input type="text" id="name" v-model="name" class="mt-1 block w-full px-3 py-2 bg-white border border-slate-300 rounded-md shadow-sm placeholder-slate-400 focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm" />
              <p v-if="nameError" class="mt-2 text-sm text-red-600">{{ nameError }}</p>
            </div>
            <div>
              <label for="email" class="block text-sm font-medium text-slate-700">E-Mail-Adresse</label>
              <input type="email" id="email" v-model="email" class="mt-1 block w-full px-3 py-2 bg-white border border-slate-300 rounded-md shadow-sm placeholder-slate-400 focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm" />
              <p v-if="emailError" class="mt-2 text-sm text-red-600">{{ emailError }}</p>
            </div>
          </div>
          <div class="text-right mt-6">
            <button type="submit" :disabled="isFormInvalid" class="px-4 py-2 rounded-md text-white font-semibold transition-colors"
              :class="{
                'bg-primary-600 hover:bg-primary-700': !isFormInvalid,
                'bg-slate-400 cursor-not-allowed': isFormInvalid
              }">
              Änderungen speichern
            </button>
          </div>
        </form>
      </div>

      <!-- Family and Planning Card -->
      <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-lg font-semibold text-slate-800 mb-4">Familie und Planung</h2>
        <form @submit.prevent="savePreferences" class="space-y-6">
          <!-- Household -->
          <div>
            <div class="grid grid-cols-2 gap-4">
              <div>
                <label class="block text-sm font-medium text-slate-600">Anzahl Erwachsene</label>
                <div class="flex items-center mt-1">
                  <button type="button" @click="numAdults > 0 && numAdults--" class="px-3 py-1 border border-slate-300 rounded-l-md hover:bg-slate-100">-</button>
                  <input type="text" :value="numAdults" readonly class="w-12 text-center border-t border-b border-slate-300" />
                  <button type="button" @click="numAdults++" class="px-3 py-1 border border-slate-300 rounded-r-md hover:bg-slate-100">+</button>
                </div>
              </div>
              <div>
                <label class="block text-sm font-medium text-slate-600">Anzahl Kinder</label>
                <div class="flex items-center mt-1">
                  <button type="button" @click="numChildren > 0 && numChildren--" class="px-3 py-1 border border-slate-300 rounded-l-md hover:bg-slate-100">-</button>
                  <input type="text" :value="numChildren" readonly class="w-12 text-center border-t border-b border-slate-300" />
                  <button type="button" @click="numChildren++" class="px-3 py-1 border border-slate-300 rounded-r-md hover:bg-slate-100">+</button>
                </div>
              </div>
            </div>
          </div>

          <!-- Dietary Preferences -->
          <div>
            <h3 class="text-md font-semibold text-slate-700 mb-2">Einschränkungen</h3>
            <div class="space-y-2">
              <div v-for="option in dietOptions" :key="option.id" class="flex items-center">
                <input type="checkbox" :id="option.id" :value="option.id" v-model="preferredDiets" class="h-4 w-4 rounded border-slate-300 text-primary-600 focus:ring-primary-500">
                <label :for="option.id" class="ml-2 block text-sm text-slate-800">{{ option.label }}</label>
              </div>
            </div>
          </div>

          <!-- Cooking Styles -->
          <div>
            <h3 class="text-md font-semibold text-slate-700 mb-2">Kochstile</h3>
            <div class="grid grid-cols-2 gap-2">
              <div v-for="option in styleOptions" :key="option.id" class="flex items-center">
                <input type="checkbox" :id="option.id" :value="option.id" v-model="cookingStyles" class="h-4 w-4 rounded border-slate-300 text-primary-600 focus:ring-primary-500">
                <label :for="option.id" class="ml-2 block text-sm text-slate-800">{{ option.label }}</label>
              </div>
            </div>
          </div>

          <!-- Disliked Ingredients -->
          <div>
            <label for="disliked-ingredients" class="block text-md font-semibold text-slate-700">Unerwünschte Zutaten</label>
            <textarea id="disliked-ingredients" v-model="dislikedIngredients" rows="3" class="mt-1 block w-full px-3 py-2 bg-white border border-slate-300 rounded-md shadow-sm placeholder-slate-400 focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm" placeholder="z.B. Rosenkohl, Leber, Oliven"></textarea>
          </div>

          <!-- AI Notes -->
          <div>
            <label for="ai-notes" class="block text-md font-semibold text-slate-700">Besondere Wünsche</label>
            <textarea id="ai-notes" v-model="aiNotes" rows="3" class="mt-1 block w-full px-3 py-2 bg-white border border-slate-300 rounded-md shadow-sm placeholder-slate-400 focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm" placeholder="z.B. Freitags immer Fisch, Montags einfache Gerichte"></textarea>
          </div>

          <!-- Save Button -->
          <div class="text-right mt-4">
            <div v-if="preferencesSuccess" class="text-green-600 text-sm text-center mb-2">{{ preferencesSuccess }}</div>
            <button type="submit" class="px-4 py-2 rounded-md text-white bg-primary-600 hover:bg-primary-700 font-semibold transition-colors">
              Präferenzen speichern
            </button>
          </div>
        </form>
      </div>

      <!-- Change Password Card -->
      <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-lg font-semibold text-slate-800 mb-4">Passwort ändern</h2>
        <form @submit.prevent="updatePassword">
          <div class="space-y-4">
            <div>
              <label for="current-password" class="block text-sm font-medium text-slate-700">Aktuelles Passwort</label>
              <input type="password" id="current-password" v-model="currentPassword" @blur="verifyCurrentPassword" class="mt-1 block w-full px-3 py-2 bg-white border border-slate-300 rounded-md shadow-sm placeholder-slate-400 focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm" />
              <div v-if="currentPasswordError" class="mt-2 text-sm text-red-600">{{ currentPasswordError }}</div>
            </div>
            <div>
              <label for="new-password" class="block text-sm font-medium text-slate-700">Neues Passwort</label>
              <input type="password" id="new-password" v-model="newPassword" class="mt-1 block w-full px-3 py-2 bg-white border border-slate-300 rounded-md shadow-sm placeholder-slate-400 focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm" />
            </div>
            <div>
              <label for="confirm-password" class="block text-sm font-medium text-slate-700">Neues Passwort bestätigen</label>
              <input type="password" id="confirm-password" v-model="confirmPassword" class="mt-1 block w-full px-3 py-2 bg-white border border-slate-300 rounded-md shadow-sm placeholder-slate-400 focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm" />
              <div v-if="newPasswordError" class="mt-2 text-sm text-red-600">{{ newPasswordError }}</div>
            </div>
          </div>
          <div v-if="passwordSuccess" class="mt-2 text-sm text-green-600">{{ passwordSuccess }}</div>
          <div v-if="generalPasswordError" class="mt-2 text-sm text-red-600">{{ generalPasswordError }}</div>
          <div class="text-right mt-6">
            <button type="submit" :disabled="isPasswordFormInvalid" class="px-4 py-2 rounded-md text-white font-semibold transition-colors"
              :class="{
                'bg-primary-600 hover:bg-primary-700': !isPasswordFormInvalid,
                'bg-slate-400 cursor-not-allowed': isPasswordFormInvalid
              }">
              Passwort ändern
            </button>
          </div>
        </form>
      </div>

    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, computed, watch } from 'vue';
import { authStore } from '@/stores/auth';
import VueCropper from 'vue-cropperjs';
import 'cropperjs/dist/cropper.css';
import axios from 'axios';

// Profile Info Refs
const name = ref('');
const email = ref('');
const nameError = ref('');
const emailError = ref('');

// Password Refs
const currentPassword = ref('');
const newPassword = ref('');
const confirmPassword = ref('');
const currentPasswordError = ref('');
const newPasswordError = ref('');
const generalPasswordError = ref('');
const passwordSuccess = ref('');
const isCurrentPasswordVerified = ref(false);

// Avatar Refs
const fileInput = ref(null);
const imageToCrop = ref(null);
const cropper = ref(null);

// Family Preferences Refs
const numAdults = ref(0);
const numChildren = ref(0);
const preferredDiets = ref([]);
const cookingStyles = ref([]);
const dislikedIngredients = ref('');
const aiNotes = ref('');
const preferencesSuccess = ref('');

const dietOptions = [
  { id: 'vegetarian', label: 'Vegetarisch' },
  { id: 'vegan', label: 'Vegan' },
];

const styleOptions = [
  { id: 'kid_friendly', label: 'Kinderfreundlich' },
  { id: 'quick_easy', label: 'Schnell & Einfach' },
  { id: 'low_calorie', label: 'Kalorienarm' },
  { id: 'whole_foods', label: 'Vollwertkost' },
];

onMounted(async () => {
  if (authStore.user) {
    name.value = authStore.user.name;
    email.value = authStore.user.email;
  }
  try {
    const response = await axios.get('/api/v1/family/get-preferences');
    const prefs = response.data;
    numAdults.value = parseInt(prefs.num_adults, 10) || 0;
    numChildren.value = parseInt(prefs.num_children, 10) || 0;
    preferredDiets.value = prefs.preferred_diets || [];
    cookingStyles.value = prefs.cooking_styles || [];
    dislikedIngredients.value = prefs.disliked_ingredients;
    aiNotes.value = prefs.ai_notes;
  } catch (error) {
    console.error('Error fetching preferences:', error);
  }
});

// --- Validation Logic ---
const validateName = () => { nameError.value = !name.value.trim() ? 'Der Name darf nicht leer sein.' : ''; };
const validateEmail = () => {
  if (!email.value.trim()) emailError.value = 'Die E-Mail-Adresse darf nicht leer sein.';
  else if (!/^\S+@\S+\.\S+$/.test(email.value)) emailError.value = 'Bitte gib eine gültige E-Mail-Adresse ein.';
  else emailError.value = '';
};
watch(name, validateName, { immediate: true });
watch(email, validateEmail, { immediate: true });
const isFormInvalid = computed(() => !!nameError.value || !!emailError.value);

const isPasswordFormInvalid = computed(() => !isCurrentPasswordVerified.value || !newPassword.value || newPassword.value !== confirmPassword.value);
watch(currentPassword, () => { isCurrentPasswordVerified.value = false; currentPasswordError.value = ''; });
watch([newPassword, confirmPassword], () => { newPasswordError.value = newPassword.value && confirmPassword.value && newPassword.value !== confirmPassword.value ? 'Die neuen Passwörter stimmen nicht überein.' : ''; });

// --- Methods ---
const openFileInput = () => fileInput.value.click();
const onFileChange = (e) => {
  const file = e.target.files[0];
  if (file) {
    const reader = new FileReader();
    reader.onload = (e) => { imageToCrop.value = e.target.result; };
    reader.readAsDataURL(file);
  }
};

const cropAndUpload = () => {
  if (!cropper.value) return;
  cropper.value.getCroppedCanvas().toBlob(async (blob) => {
    const formData = new FormData();
    formData.append('avatar', blob, 'avatar.jpg');
    try {
      const response = await axios.post('/api/v1/user/update-avatar', formData, { headers: { 'Content-Type': 'multipart/form-data' } });
      authStore.user.avatar_url = response.data.avatar_url;
      imageToCrop.value = null;
    } catch (error) { console.error('Error uploading avatar:', error); }
  }, 'image/jpeg');
};

const deleteAvatar = async () => {
  try {
    await axios.post('/api/v1/user/delete-avatar');
    authStore.user.avatar_url = null;
  } catch (error) { console.error('Error deleting avatar:', error); }
};

const updateProfile = async () => {
  validateName();
  validateEmail();
  if (isFormInvalid.value) return;
  try {
    const response = await axios.post('/api/v1/user/update-profile', { name: name.value, email: email.value });
    authStore.user.name = response.data.user.name;
    authStore.user.email = response.data.user.email;
  } catch (error) { console.error('Error updating profile:', error); }
};

const verifyCurrentPassword = async () => {
  if (!currentPassword.value) { isCurrentPasswordVerified.value = false; return; }
  try {
    const response = await axios.post('/api/v1/user/verify-password', { current_password: currentPassword.value });
    if (response.data.isValid) {
      isCurrentPasswordVerified.value = true;
      currentPasswordError.value = '';
    } else {
      isCurrentPasswordVerified.value = false;
      currentPasswordError.value = 'Das aktuelle Passwort ist nicht korrekt.';
    }
  } catch (error) {
    isCurrentPasswordVerified.value = false;
    currentPasswordError.value = 'Fehler bei der Passwort-Prüfung.';
    console.error('Error verifying password:', error);
  }
};

const updatePassword = async () => {
  currentPasswordError.value = '';
  newPasswordError.value = '';
  generalPasswordError.value = '';
  passwordSuccess.value = '';
  if (newPassword.value !== confirmPassword.value) { newPasswordError.value = 'Die neuen Passwörter stimmen nicht überein.'; return; }
  await verifyCurrentPassword();
  if (!isCurrentPasswordVerified.value) return;
  try {
    await axios.post('/api/v1/user/update-password', { current_password: currentPassword.value, new_password: newPassword.value });
    passwordSuccess.value = 'Dein Passwort wurde erfolgreich geändert.';
    currentPassword.value = '';
    newPassword.value = '';
    confirmPassword.value = '';
    isCurrentPasswordVerified.value = false;
  } catch (error) {
    generalPasswordError.value = 'Ein Fehler ist aufgetreten. Bitte versuche es erneut.';
    console.error('Error updating password:', error);
  }
};

const savePreferences = async () => {
  try {
    const payload = {
      num_adults: numAdults.value,
      num_children: numChildren.value,
      preferred_diets: preferredDiets.value,
      cooking_styles: cookingStyles.value,
      disliked_ingredients: dislikedIngredients.value,
      ai_notes: aiNotes.value,
    };
    await axios.post('/api/v1/family/update-preferences', payload);
    preferencesSuccess.value = 'Deine Präferenzen wurden erfolgreich gespeichert.';
    setTimeout(() => {
      preferencesSuccess.value = '';
    }, 3000);
  } catch (error) {
    console.error('Error saving preferences:', error);
    // Optionally, show an error message
  }
};

</script>
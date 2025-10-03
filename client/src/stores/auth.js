import { reactive } from 'vue';

export const authStore = reactive({
  isAuthenticated: false,
  user: null,

  authenticate(userData) {
    this.isAuthenticated = true;
    this.user = userData;
  },

  clear() {
    this.isAuthenticated = false;
    this.user = null;
  }
});

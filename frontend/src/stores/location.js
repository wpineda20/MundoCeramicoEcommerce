import { ref } from "vue";
import { defineStore } from "pinia";

export const useLocationStore = defineStore("location", () => {
  const center = ref(null);
  const selectedDestination = ref(null);

  return {
    center,
    selectedDestination,
  };
});

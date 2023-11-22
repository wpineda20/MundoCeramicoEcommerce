import { defineStore } from "pinia";
import { ref } from "vue";

export const useCarousel = defineStore("carousel", () => {
  const carousels = ref([]);
  const loadingCarousel = ref(false);

  return {
    carousels,
    loadingCarousel,
  };
});

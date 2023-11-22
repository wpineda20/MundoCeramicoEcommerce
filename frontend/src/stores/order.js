import { defineStore } from "pinia";
import { ref } from "vue";

export const useOrder = defineStore("order", () => {
  const orders = ref([]);
  const total = ref(0);
  const loadingOrder = ref(false);

  return {
    total,
    orders,
    loadingOrder,
  };
});

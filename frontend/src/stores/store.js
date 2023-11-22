import { defineStore } from "pinia";
import { ref } from "vue";

export const useStore = defineStore("store", () => {
  const stores = ref([]);
  const selectedStore = ref(null);
  const typeDelivery = ref("delivery");
  const loadingStore = ref(false);

  return {
    stores,
    selectedStore,
    typeDelivery,
    loadingStore,
  };
});

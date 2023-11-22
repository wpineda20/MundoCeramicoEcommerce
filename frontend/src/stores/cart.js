import { defineStore } from "pinia";
import { ref } from "vue";

export const useStoreCart = defineStore("cart", () => {
  const products = ref([]);
  const address = ref("");
  const subtotal = ref(0.0);
  const deliveryCost = ref(0.0);
  const promotionalDiscount = ref(0.0);

  return {
    products,
    subtotal,
    deliveryCost,
    promotionalDiscount,
    address,
  };
});

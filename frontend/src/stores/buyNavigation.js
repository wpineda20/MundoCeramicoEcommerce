import { defineStore } from "pinia";
import { ref } from "vue";

export const useBuyNavigationStore = defineStore("buyNavigation", () => {
  const step = ref(1);
  const tabs = ref([
    {
      title: "Seleccionar tienda",
      iconSuccess: null,
      isValid: false,
    },
    {
      title: "Destino",
      iconSuccess: null,
      isValid: false,
    },
    {
      title: "Verificar carrito",
      iconSuccess: null,
      isValid: true,
    },
    {
      title: "Confirmación",
      iconSuccess: null,
      isValid: true,
    },
  ]);

  return {
    step,
    tabs,
  };
});

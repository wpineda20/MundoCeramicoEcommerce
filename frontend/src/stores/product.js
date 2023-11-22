import { defineStore } from "pinia";
import { ref } from "vue";

export const useProductStore = defineStore("product", () => {
  const productInfo = ref([]);
  const categories = ref([]);
  const loading = ref(false);
  const page = ref(1);
  const totalPages = ref(0);
  const search = ref('');
  const filterActive = ref(false);

  const selectedProduct = ref(null);
  const selectedCategory = ref(null);

  // console.log(filterActive)

  return {
    productInfo,
    categories,
    selectedProduct,
    selectedCategory,
    loading,
    page,
    totalPages,
    search,
    filterActive,
  };
});

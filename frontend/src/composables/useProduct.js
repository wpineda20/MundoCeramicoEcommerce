import { watch } from "vue";
import { storeToRefs } from "pinia";

import { useProductStore } from "../stores/product";

import epcomApi from "../services/epcomApi";
import { useRouter } from "vue-router";
import { toast } from "vue3-toastify";

const useProduct = () => {
  const productStore = useProductStore();
  const {
    loading,
    productInfo,
    categories,
    selectedProduct,
    selectedCategory,
    page,
    totalPages,
    search,
    filterActive
  } = storeToRefs(productStore);
  const router = useRouter();

  const setSelectedProduct = (product) => {
    selectedProduct.value = product;
  };

  const getSelectedProduct = async (id) => {
    try {
      const { data } = await epcomApi.get("/products/" + id);

      selectedProduct.value = data.data;
    } catch (error) {
      console.log(error);
    }
  };

  const getCategories = async () => {
    // loading.value = true;
    const { data } = await epcomApi.get("/categories");

    // console.log(data.data)
    categories.value = data.data;
    // loading.value = false;
  }

  const getProductsByCategory = async (category, redirect = false) => {
    // console.log(redirect)
    loading.value = true;

    const { data } = await epcomApi.get("/productsByCategory", {
      params: { category: category.name, page: page.value }
    });

    productInfo.value = data.data.data;
    selectedCategory.value = category;
    totalPages.value = data.data.pages;
    loading.value = false;
    filterActive.value = false;
    search.value = '';

    if (redirect) {
      router.push('/')
    }
  }

  const searchProducts = async (e) => {
    e.preventDefault();

    loading.value = true;

    if (search.value == '') {
      toast.error('Debes digitar un valor de búsqueda')
    }

    const { data } = await epcomApi.get("/products/search", {
      params: { search: search.value.toUpperCase(), page: page.value }
    });

    if (router.currentRoute.value != '/') {
      router.push('/');
    }

    productInfo.value = data.data.products;
    totalPages.value = data.data.pages;
    loading.value = false;
    filterActive.value = true;
  }

  watch(page, (newVal, oldVal) => {
    if (newVal !== oldVal && !loading.value && search.value == '') {
      getProductsByCategory(selectedCategory.value);
    } else if (search.value) {
      searchProducts();
    }
  })

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

    getSelectedProduct,
    setSelectedProduct,
    getCategories,
    getProductsByCategory,
    searchProducts,
  };
};

export default useProduct;

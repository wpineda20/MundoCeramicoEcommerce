import { storeToRefs } from "pinia";
import { useStore } from "../stores/store";

import backendApi from "@/services/backendApi";

const useStoreLocation = () => {
  const storeStore = useStore();
  const { stores, selectedStore, typeDelivery, loadingStore } =
    storeToRefs(storeStore);

  const getStores = async () => {
    loadingStore.value = true;
    try {
      const { data } = await backendApi.get("/store", {
        params: {
          itemsPerPage: -1,
        }
      });

      stores.value = data.data;
    } catch (error) {
      console.error(error);
    }
    loadingStore.value = false;
  };

  return {
    stores,
    selectedStore,
    typeDelivery,
    loadingStore,

    getStores,
  };
};

export default useStoreLocation;

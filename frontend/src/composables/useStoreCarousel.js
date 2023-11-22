import { storeToRefs } from "pinia";
import { useCarousel } from "../stores/carousel";

import backendApi from "@/services/backendApi";

const useStoreCarousel = () => {
  const storeCarousel = useCarousel();
  const { carousels, loadingCarousel } = storeToRefs(storeCarousel);

  const getCarousel = async () => {
    loadingCarousel.value = true;
    try {
      const { data } = await backendApi.get("/activeCarousel");
      carousels.value = data.data;
    } catch (error) {
      console.error(error);
    }
    loadingCarousel.value = false;
  };

  return {
    carousels,
    loadingCarousel,

    getCarousel,
  };
};

export default useStoreCarousel;

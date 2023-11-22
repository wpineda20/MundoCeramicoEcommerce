import { storeToRefs } from "pinia";
import { useOrder } from "../stores/order";

import backendApi from "@/services/backendApi";

const useStoreOrder = () => {
  const storeOrder = useOrder();
  const { orders, total, loadingOrder } = storeToRefs(storeOrder);

  const getOrders = async () => {
    loadingOrder.value = true;
    try {
      const { data } = await backendApi.get("/myOrder");
      orders.value = data.records;
    } catch (error) {
      console.error(error);
    }
    loadingOrder.value = false;
  };

  return {
    orders,
    total,
    loadingOrder,

    getOrders,
  };
};

export default useStoreOrder;

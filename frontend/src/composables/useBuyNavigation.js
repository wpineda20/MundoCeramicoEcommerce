import { storeToRefs } from "pinia";
import { useBuyNavigationStore } from "../stores/buyNavigation";

const useBuyNavigation = () => {
  const buyNavigationStore = useBuyNavigationStore();

  const { step, tabs } = storeToRefs(buyNavigationStore);

  const enableButton = (store) => {
    // Enabling next button
    tabs.value[step.value - 1].isValid = true;
  };

  return {
    step,
    tabs,
    enableButton,
  };
};

export default useBuyNavigation;

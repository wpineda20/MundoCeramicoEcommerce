<script setup>
import { Steppy } from "vue3-steppy";
import SelectStore from "@/components/products/SelectStore.vue";

import useBuyNavigation from "@/composables/useBuyNavigation";
import ProcessPayment from "../../components/products/ProcessPayment.vue";
import SelectDelivery from "../../components/products/SelectDelivery.vue";
import CartDetail from "../../components/CartDetail.vue";
import useCart from "../../composables/useCart";
import { onMounted } from "vue";
import { useRouter } from "vue-router";

const { step, tabs } = useBuyNavigation();
const { products } = useCart();
const router = useRouter();

onMounted(() => {
  // if (products.value.length == 0) {
  //   router.push('/')
  // }
})
</script>
    
<template>
  <v-container class="text-left">
    <h2>Complete su compra</h2>

    <steppy v-model:step="step" :tabs="tabs" nextText="Siguiente" backText="Anterior" doneText="Completar pago"
      primaryColor1="#000C27" class="mt-0 pt-3 px-0">
      <template #1>
        <SelectStore />
      </template>
      <template #2>
        <SelectDelivery />
      </template>
      <template #3>
        <CartDetail />
      </template>
      <template #4>
        <ProcessPayment />
      </template>
    </steppy>
  </v-container>
</template>
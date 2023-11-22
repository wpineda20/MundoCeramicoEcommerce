<script setup>
import { onMounted } from "vue";

import Cart from "./Cart.vue";
import CartTotal from "./CartTotal.vue";

import useCart from "@/composables/useCart";
import BaseButton from "./base-components/BaseButton.vue";
import useBuyNavigation from "@/composables/useBuyNavigation";
import { toast } from "vue3-toastify";

const { products, calculateSubtotal } = useCart();
const { step } = useBuyNavigation();

onMounted(() => {
  calculateSubtotal();
});

const nextStep = () => {
  if (!products.value || products.value.length == 0) {
    toast.error(
      "Debes tener al menos 1 producto dentro de tu carrito para continuar con la compra"
    );
    return;
  }

  step.value += 1;
};
</script>

<template>
  <v-container>
    <v-row>
      <v-col cols="12" md="12">
        <h2 class="text-left">Resumen</h2>
        <Cart />
      </v-col>
      <v-col cols="12" md="6" class="text-left">
        <h2>Total de la compra</h2>
        <CartTotal />
      </v-col>

      <v-col cols="12" md="12">
        <div class="d-flex flex-row mt-5 pt-5 mb-0">
          <BaseButton title="Regresar" type="primary" @click="step -= 1" />
          <v-spacer />
          <BaseButton title="Siguiente" type="primary" @click="nextStep()" />
        </div>
      </v-col>
    </v-row>
  </v-container>
</template>
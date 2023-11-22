<script setup>
import { useRouter } from "vue-router";

import BaseButton from "../../components/base-components/BaseButton.vue";
import BaseInput from "../../components/base-components/BaseInput.vue";

import useCart from "@/composables/useCart";
import Cart from "../../components/Cart.vue";
import CartTotal from "../../components/CartTotal.vue";
import { toast } from "vue3-toastify";

const {
  products,
  subtotal,
  deleteProductFromCart,
  // buyProducts,
  applyPromotionalCode,
} = useCart();

const router = useRouter();

const gotToBuy = () => {
  // if (!products.value || products.value.length == 0) {
  //   toast.error('Debes tener al menos un producto en tu carrito para registrar tu pedido')
  //   return;
  // }

  router.push('/buy');
}
</script>
    
<template>
  <v-container>
    <v-card class="p-4 shadow">
      <h1>Resumen de compra</h1>

      <v-row class="mt-3">
        <!-- Cart product -->
        <v-col cols="12" md="12">
          <Cart />
        </v-col>
        <!-- Cart product -->

        <v-col cols="12" md="5">
          <!-- Promotional code -->
          <!-- <h4>Código promocional</h4>
          <div class="d-flex flex-column mb-3">
            <BaseInput placeholder="Ingresa el código" class="w-100 my-auto" />
            <BaseButton title="Aplicar" type="secondary" class="my-2 w-100" @click="applyPromotionalCode()" />
          </div> -->
          <!-- Promotional code -->

          <!-- Delivery -->
          <h4 class="mb-3">Detalle de la compra</h4>
          <CartTotal />

          <!-- Delivery -->

          <BaseButton title="Registrar pedido" type="primary" class="w-100" @click="gotToBuy()" />
        </v-col>
      </v-row>
    </v-card>
  </v-container>
</template>

<style scoped>
td {
  padding: 0 !important;
}

.value-table {
  width: 20%;
}
</style>

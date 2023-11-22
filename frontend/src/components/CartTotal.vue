<script setup>
import useCart from "@/composables/useCart";

const {
  products,
  subtotal,
  deleteProductFromCart,
  deliveryCost,
  promotionalDiscount,
  applyPromotionalCode,
} = useCart();
</script>

<template>
  <v-table class="mb-3">
    <tbody>
      <!-- <tr v-if="deliveryCost > 0">
          <td>Costo de envío</td>
          <td class="value-table">$ {{ deliveryCost }}</td>
        </tr> -->
      <!-- <tr v-if="promotionalDiscount > 0">
        <td>Descuento código promocional</td>
        <td class="value-table">$ {{ promotionalDiscount }}</td>
      </tr> -->
      <tr>
        <td>Total</td>
        <td class="value-table">$ {{ subtotal.toFixed(2) }}</td>
      </tr>
    </tbody>
  </v-table>
</template>
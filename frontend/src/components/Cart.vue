<script setup>
import useCart from "@/composables/useCart";

const {
  products,
  subtotal,
  deleteProductFromCart,
  // buyProducts,
  applyPromotionalCode,
  calculateSubtotal,
} = useCart();

const validateText = (item) => {
  item.quantity = (item.quantity == 0) ? 1 : item.quantity;
  // console.log(item.quantity)
  item.quantity = item.quantity.toString().replace(/[^0-9\-]/g, '');
}
</script>

<template>
  <v-table>
    <thead>
      <tr class="text-center">
        <th>Producto</th>
        <th>Precio Unitario</th>
        <th>Cantidad</th>
        <th>Subtotal</th>
        <th>Acciones</th>
      </tr>
    </thead>

    <tbody>
      <tr v-for="(item, index) in products" :key="index" class="text-left">
        <td style="max-width: 300px">
          <v-row class="my-auto">
            <v-col cols="12" md="4" class="pe-0">
              <v-img :src="item.product.img_portada" width="100" height="100"></v-img>
            </v-col>
            <v-col cols="12" md="7" class="p-0 my-auto">
              <p>{{ item.product.titulo }}</p>
            </v-col>
          </v-row>
        </td>
        <td>
          $ {{ item.product.precios.final_price }}
        </td>
        <td>
          <input type="number" v-model="item.quantity" min="1" step="1" @change="calculateSubtotal()"
            @keyup="validateText(item)" />
        </td>
        <td>
          $ {{ (item.product.precios.final_price * item.quantity).toFixed(2) }}
        </td>
        <td>
          <v-icon icon="mdi-delete" @click="deleteProductFromCart(index)" />
        </td>
      </tr>
      <tr v-if="products.length == 0">
        <td colspan="4" class="text-center">
          No se encontraron productos dentro del carrito.
        </td>
      </tr>
    </tbody>
  </v-table>
</template>
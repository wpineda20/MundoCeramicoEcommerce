<script setup>
import { useRouter } from "vue-router";

import BaseButton from "@/components/base-components/BaseButton.vue";
import useAuth from "@/composables/useAuth";

const router = useRouter();
const { isLoggedIn } = useAuth();

const props = defineProps({
  product: {
    required: true,
    type: Object,
  },
});

const showProduct = (product) => {
  router.push("/preview/product/" + product.producto_id);
};
</script>

<template>
  <v-card class="shadow my-1" @click="showProduct(product)" :ripple="false">
    <v-img :src="product.img_portada" height="200px"></v-img>
    <v-card-item>
      <v-card-title class="d-flex justify-space-between">
        <h3>{{ product.titulo }}</h3>
      </v-card-title>

      <v-card-text class="mt-3 p-0">
        <span><b>Modelo: </b> {{ product.modelo }}</span>
        <br />
        <span><b>Marca: </b> {{ product.marca }}</span>
        <h2 class="mt-3" v-if="isLoggedIn">$ {{ product.precios.final_price }}</h2>
      </v-card-text>
    </v-card-item>
    <v-card-actions class="d-flex flex-column">
      <base-button class="w-100 mx-0" type="primary" title="Ver producto" />
    </v-card-actions>
  </v-card>
</template>
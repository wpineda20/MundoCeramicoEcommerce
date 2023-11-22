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
  <v-card class="shadow my-1" :ripple="false">
    <v-img src="/test/cabinet.jpg" height="200px"></v-img>
    <v-card-item>
      <v-card-title class="d-flex justify-space-between">
        <h3>Titulo</h3>
      </v-card-title>

      <v-card-text class="mt-3 p-0">
        <span><b>Modelo: </b> Modelo</span>
        <br />
        <span><b>Marca: </b> Marca</span>
        <h2 class="mt-3">$ 400.00</h2>
      </v-card-text>
    </v-card-item>
    <v-card-actions class="d-flex flex-column">
      <base-button class="w-100 mx-0" type="primary" title="Ver producto" />
    </v-card-actions>
  </v-card>
</template>
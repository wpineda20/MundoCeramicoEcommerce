<script setup>
import { RouterLink } from "vue-router";
</script>

<template>
  <v-container>
    <v-row class="mx-auto text-center my-5">
      <v-col cols="12" md="12" align="center">
        <v-img src="/logos/logo_nuevo.jpg" width="175px" />
      </v-col>
      <v-col cols="12" md="12" align="center">
        <h1 class="py-3">¡Gracias por tu compra!</h1>

        <p style="font-size: 20px" class="my-5">
          Tu compra ha sido recibida. <br />
          Recibirás notificaciones de tu proceso de compra próximamente.
        </p>
      </v-col>

      <v-col cols="12">
        <RouterLink to="/" class="btn btn-primary p-3">
          <a href="#" class="mt-5 text-white">Volver al inicio</a>
        </RouterLink>
      </v-col>
    </v-row>
  </v-container>
</template>

<style scoped>
h1 {
  color: black;
}

.text-white {
  color: white;
}
</style>
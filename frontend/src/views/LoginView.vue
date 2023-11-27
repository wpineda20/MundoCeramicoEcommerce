<template>
  <div class="d-flex justify-content-center">
    <v-card class="text-center p-5 pt-5 pb-5 mb-5 mt-5 shadow">
      <v-img class="mx-auto" src="/logos/logo_azul_negro_rombo_rojo.png" style="max-width: 250px" />
      <h2 class="pb-1" style="color: #000C27">
        Ingresa tus datos para iniciar
      </h2>
      <!-- title="Iniciar sesión" -->
      <base-button
        title="Iniciar sesion"
        type="primary"
        class="mt-5 mb-3 p-5 py-0"
        @click="redirectToProvider()"
        :disabled="false"
      />
    </v-card>
  </div>
</template>

<script setup>
import { onMounted } from "vue";
import useAuth from "../composables/useAuth";
import BaseButton from "../components/base-components/BaseButton.vue";
import { useRouter } from "vue-router";
import gatewayApi from "../services/gatewayApi";
const {
  challenge,
  state,
  verifier,
  isLoggedIn,
  cryptoSha256,
  createRandomString,
  base64Url,
  redirectToProvider,
} = useAuth();
const router = useRouter();

onMounted(async () => {
  state.value = createRandomString(40);
  verifier.value = createRandomString(128);

  challenge.value = base64Url(cryptoSha256(verifier.value));
  localStorage.setItem("state", state.value);
  localStorage.setItem("verifier", verifier.value);
});
</script>

<style scoped>
h2 {
  font-size: 26px;
  font-weight: normal;
}
</style>

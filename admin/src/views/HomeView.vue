<script setup>
import { RouterLink } from "vue-router";
import useMenu from "@/composables/useMenu";
import useAuth from "@/composables/useAuth";
import { ref } from "vue";

const { stateSideBar } = useMenu();
const { user, isLoggedIn, logout } = useAuth();
const { redirectAndGenerateChallenge } = useAuth();
const registerUrl = ref(import.meta.env.VITE_BACKEND_URL + "/register");
</script>

<template>
  <div class="pb-5 pt-5">
    <v-container>
      <v-row>
        <v-col cols="12" md="4" align="center" offset-md="4">
          <img src="/logos/lobo.png" alt="" />
          <h2 class="fw-normal text-black fs-1 pt-3 pb-2" style="line-height: 34px" v-if="user">
            Bienvenido {{ user.name }}
          </h2>
          <h4 class="pt-3 pb-3 fw-normal fs-5 text-black">
            Has accedido al panel administrativo, ahora puedes gestionar todo lo
            relacionado con la tienda en línea.
          </h4>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<style scoped>
.pagination {
  margin: 3.5rem 0;
}
</style>

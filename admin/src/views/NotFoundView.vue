<template>
  <div class="main-content main-content-404 right-sidebar">
    <v-container>
      <v-row>
        <v-col
          cols="12"
          lg="12"
          md="12"
          sm="12"
          xs="12"
          class="content-area content-404"
        >
          <div class="site-main">
            <section class="error-404 not-found">
              <div class="images">
                <img
                  src="/images/404-error.png"
                  alt="img"
                  width="400"
                  height="400"
                />
              </div>
              <div class="text-404">
                <h1 class="page-title">¡Vaya! Pagina no encontrada.</h1>
                <p class="page-content pb-2">
                  Lo sentimos, esta página no existe. Puede volver a la página
                  inicial.
                </p>
                <RouterLink to="/"
                  ><button class="button btn-submit">VOLVER AL INICIO</button>
                </RouterLink>

                <!-- <BaseButton
                  title="Inicio"
                  type="secondary"
                  class="mt-3"
                  to="/"
                /> -->
              </div>
            </section>
          </div>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script setup>
import BaseButton from "../components/base-components/BaseButton.vue";
</script>

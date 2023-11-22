<script setup>
import { onMounted } from "vue";

import { toast } from "vue3-toastify";

import BaseButton from "@/components/base-components/BaseButton.vue";
import Loader from "@/components/base-components/Loader.vue";

import useStoreLocation from "@/composables/useStoreLocation";
import useBuyNavigation from "@/composables/useBuyNavigation";
import useAuth from "@/composables/useAuth";

const { selectedStore, stores, loadingStore, getStores } = useStoreLocation();
const { step, enableButton } = useBuyNavigation();
const { loadingAuth } = useAuth();

const selectStore = (store) => {
  selectedStore.value = store;
};

const nextStep = () => {
  if (!selectedStore.value) {
    toast.error("Debes seleccionar una tienda antes de continuar");
    return;
  }

  step.value += 1;
};

onMounted(getStores);
</script>

<template>
  <v-col cols="12" md="12" v-if="selectedStore" class="text-left">
    <h3 class="text-left">Tienda seleccionada</h3>
    <hr />
    <p class="mt-3"><b>Nombre:</b> {{ selectedStore.name }}</p>
    <p><b>Dirección:</b> {{ selectedStore.address }}</p>
    <p class="mt-3 text-primary">
      <b> NOTA:</b> Recuerda que una tienda más lejana de tu ubicación puede
      suponer un cargo extra de envío.
    </p>
  </v-col>

  <v-container class="pb-0" v-if="!loadingStore">
    <h3 class="text-left">Tiendas disponibles</h3>
    <hr />

    <v-row v-if="stores.length > 0">
      <v-col cols="12" md="6" v-for="(store, index) in stores" :key="index" class="mt-3">
        <v-card-title>{{ store.name }}</v-card-title>
        <v-card-text class="text-left">{{ store.address }}</v-card-text>
        <v-card-actions>
          <base-button title="Seleccionar" type="secondary" @click="selectStore(store)" />
        </v-card-actions>
      </v-col>
    </v-row>

    <v-row v-else class="my-3">
      <v-col cols="12" md="12" class="mt-3">
        <p>No se encontraron tiendas disponibles.</p>
      </v-col>
    </v-row>

    <div class="d-flex flex-row mt-5 pt-5 mb-0">
      <v-spacer />
      <base-button title="Siguiente" type="primary" @click="nextStep()" />
    </div>
  </v-container>
  <Loader v-else />
</template>
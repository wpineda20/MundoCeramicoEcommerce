<script setup>
import { computed, onMounted, watch } from "vue";

import BaseButton from "@/components/base-components/BaseButton.vue";

import Map from "../Map.vue";

import useStoreLocation from "@/composables/useStoreLocation";
import useLocation from "@/composables/useLocation";
import useBuyNavigation from "../../composables/useBuyNavigation";
import useCart from "@/composables/useCart";
import { toast } from "vue3-toastify";

const { selectedStore, typeDelivery } = useStoreLocation();
const {
  map,
  center,
  markerInitial,
  markerDestination,
  createMarker,
  createPopup,
  createMap,
  selectedDestination,
} = useLocation();
const { address } = useCart();
const { step } = useBuyNavigation();

onMounted(() => {
  initialize();
});

const initialize = () => {
  // console.log(selectedStore.value)
  center.value = [
    selectedStore.value.location.longitude,
    selectedStore.value.location.latitude,
  ];
  createMap();

  createInitialMarker();
}

const createInitialMarker = () => {
  if (markerInitial.value) markerInitial.value.remove();

  markerInitial.value = createPopup("Estás aquí");

  let marker = createMarker({
    lng: selectedStore.value.location.longitude,
    lat: selectedStore.value.location.latitude,
    color: "red",
    popup: markerInitial.value,
  });

  marker.addTo(map.value);
};

const meterToKm = computed(() => {
  return (selectedDestination.value.distance / 1000).toFixed(2);
});

const nextStep = () => {
  if (!selectedDestination.value || !selectedDestination.value.name) {
    toast.error("Selecciona un punto de entrega valido para tu pedido");
    return;
  }

  if (!address.value && typeDelivery.value == 'delivery') {
    toast.error("La direccón de entrega es requerida");
    return;
  }

  step.value += 1;
};

watch(typeDelivery, (newVal) => {
  // console.log(newVal)
  if (newVal == 'delivery') {
    selectedDestination.value = null;

    setTimeout(() => {
      initialize();
    }, 100);
    return;
  }

  selectedDestination.value = selectedStore.value;
})
</script>

<template>
  <h2 class="text-left">Selecciona el punto de entrega</h2>


  <v-radio-group inline class="mt-4 mb-3" v-model="typeDelivery">
    <v-radio label="Entrega a domicilio" value="delivery"></v-radio>
    <v-radio label="Entrega en tienda" value="store"></v-radio>
  </v-radio-group>

  <Map class="px-0" v-if="typeDelivery == 'delivery'" />

  <div v-if="selectedDestination && typeDelivery == 'delivery'" class="text-left">
    <h3 class="mb-2">Lugar de entrega seleccionado</h3>

    <p><b>Lugar de referencia:</b> {{ selectedDestination.name }}</p>
    <p><b>Distancia:</b> {{ meterToKm }} Km.</p>

    <v-textarea label="Dirección" variant="outlined" class="mt-4" rows="2" v-model="address" />
  </div>

  <div class="d-flex flex-row mt-5 pt-5 mb-0">
    <BaseButton title="Regresar" type="primary" @click="step -= 1" />
    <v-spacer />
    <BaseButton title="Siguiente" type="primary" @click="nextStep()" />
  </div>
</template>
<script setup>
import { ref } from "vue";

import { useRouter } from "vue-router";
import { toast } from "vue3-toastify";

import backendApi from "@/services/backendApi";

import BaseButton from "../base-components/BaseButton.vue";
import Loader from "../base-components/Loader.vue";

import useBuyNavigation from "@/composables/useBuyNavigation";
import useCart from "@/composables/useCart";
import useAuth from "@/composables/useAuth";
import useStoreLocation from "@/composables/useStoreLocation";
import useLocation from "@/composables/useLocation";

const { step } = useBuyNavigation();
const { products, clearCart, subtotal, address } = useCart();
const { selectedStore, typeDelivery } = useStoreLocation();
const { user, loadingAuth } = useAuth();
const { selectedDestination } = useLocation();

const router = useRouter();

const disableButtons = ref(false);

const nextStep = async () => {
  if (products.value.length == 0) {
    toast.error("Debes tener al menos un producto dentro del carrito.");
  }

  if (!selectedStore.value) {
    toast.error("Debes de seleccionar una tienda para registrar un pedido.");
  }

  if (!address.value && typeDelivery.value == 'delivery') {
    toast.error("Debes de seleccionar una tienda para registrar un pedido.");
  }

  if (!user.value) {
    toast.error("Debes estar autenticado para registrar un pedido.");
  }

  disableButtons.value = true;

  const order = {
    cart: products.value,
    subtotal: subtotal.value,
    store: selectedStore.value,
    location: selectedDestination.value,
    typeDelivery: typeDelivery.value,
    address: address.value,
  }

  await toast.promise(backendApi.post('/order', order), {
    pending: {
      render() {
        return "Registrando tu pedido. Por favor espere...";
      },
      icon: false,
    },
    success: {
      render({ data }) {
        // setTimeout(() => {
        router.push("/thanks");

        clearCart();
        step.value = 1;
        disableButtons.value = false;
        // }, 2000);

        return;
      },
      icon: '🟢',
    },
    error: {
      render(err) {
        disableButtons.value = false;
        // When the promise reject, data will contains the error
        // return h('div', 'Err: ' + err.data.message);
        return 'Error: ' + err.data.message;
      },
    }
  });
};
</script>

<template>
  <v-container>
    <v-row v-if="!loadingAuth">
      <v-col cols="12" md="12" align="center">
        <v-img src="/logos/lobo.png" width="175px" />
      </v-col>

      <v-col cols="12" md="12" align="center">
        <h2 v-if="user" class="py-3">{{ user.name }}, <br> ¡estás a punto de registrar tu pedido!</h2>

        <p style="font-size: 20px" class="my-5">
          Para validar que la información ingresada es correcta, presiona el botón de confirmar.
        </p>
      </v-col>

      <v-col cols="12">
        <BaseButton title="Confirmar mi pedido" type="secondary" :disabled="disableButtons || !user"
          @click="nextStep()" />
      </v-col>
    </v-row>
    <v-row v-if="loadingAuth">
      <v-col cols="12" md="12" align="center">
        <Loader />
      </v-col>
    </v-row>

    <div class="d-flex flex-row mt-5 pt-5 mb-0">
      <BaseButton title="Regresar" type="primary" :disabled="disableButtons" @click="step -= 1" />
    </div>
  </v-container>
</template>
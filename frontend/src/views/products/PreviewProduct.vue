<script setup>
import { computed, onMounted, ref, watch } from "vue";

import useVuelidate from "@vuelidate/core";
import { helpers, minValue, required, email } from "@vuelidate/validators";

import BaseButton from "@/components/base-components/BaseButton.vue";
import BaseInput from "@/components/base-components/BaseInput.vue";

import useProduct from "@/composables/useProduct";
import useAlert from "@/composables/useAlert";
import useCart from "@/composables/useCart";
import { useRoute } from "vue-router";
import Loader from "@/components/base-components/Loader.vue";
import { toast } from "vue3-toastify";

import { messages } from "@/utils/validators/i18n-validators";
import useAuth from "@/composables/useAuth";

const langMessages = messages["es"].validations;

const route = useRoute();

const { alert } = useAlert();
const { selectedProduct, getSelectedProduct } = useProduct();
const { addProductToCart } = useCart();
const { isLoggedIn, redirectAndGenerateChallenge } = useAuth();

const quantity = ref(1);
const loading = ref(false);
const dialog = ref(false);

onMounted(async () => {
  loading.value = true;

  await getSelectedProduct(route.params.id);

  loading.value = false;
});

const rules = {
  quantity: {
    required,
    minValue: helpers.withMessage(
      ({ $params }) => langMessages.minValue($params),
      minValue(1)
    ),
  },
};

const v$ = useVuelidate(rules, {
  quantity,
});

const validateForm = async () => {
  if (!(await v$.value.$validate())) {
    toast.error("Campos requeridos.");
    return;
  }

  addProductToCart(selectedProduct.value, quantity.value);
};

const weightUnit = computed(() => {
  return `${selectedProduct.value.peso} ${selectedProduct.value.peso_unidad}`;
});

const dimensions = computed(() => {
  return `${selectedProduct.value.largo} x ${selectedProduct.value.ancho} x ${selectedProduct.value.alto} ${selectedProduct.value.dimensiones_unidad}`;
});

const convertHtml = (html) => {
  // let html
  html = html.replaceAll('class="fila"', 'class="row"');
  html = html.replaceAll('class="container"', 'class="row"');
  html = html.replaceAll('class="col-sm-4"', 'class="col-sm-4 col-md-4 py-4"');
  html = html.replaceAll(
    'class="img-responsive"',
    'style="width: 100%; height: auto"'
  );
  html = html.replaceAll(
    'class="img-responsive fr-fil fr-dib"',
    'style="width: 100%; height: auto"'
  );
  html = html.replaceAll(
    'class="center img-responsive fr-fil fr-dib"',
    'style="width: 300px; height: auto"'
  );
  html = html.replaceAll(
    'style="border-left: 5px solid #0091ff; border-radius: 5px; padding: 5px; box-shadow: 2px 2px 10px #d8d8d8; -webkit-box-shadow: 2px 2px 10px #d8d8d8;"',
    'style="border-left: 5px solid #0091ff; border-radius: 5px; padding: 25px; box-shadow: 2px 2px 10px #d8d8d8; -webkit-box-shadow: 2px 2px 10px #d8d8d8;"'
  );
  html = html.replaceAll(
    'style="box-sizing: border-box; border-left-width: 5px; border-left-style: solid; border-left-color: #0091ff; border-top-left-radius: 5px; border-top-right-radius: 5px; border-bottom-right-radius: 5px; border-bottom-left-radius: 5px; padding: 5px; box-shadow: #d8d8d8 2px 2px 10px; line-height: 1.5;"',
    'style="box-sizing: border-box; border-left-width: 5px; border-left-style: solid; border-left-color: #0091ff; border-top-left-radius: 5px; border-top-right-radius: 5px; border-bottom-right-radius: 5px; border-bottom-left-radius: 5px; padding: 25px; box-shadow: #d8d8d8 2px 2px 10px; line-height: 1.5;"'
  );
  html = html.replaceAll(
    'style="box-sizing: border-box; position: relative; min-height: 1px; padding-left: 15px; padding-right: 15px; float: left; width: 333.328125px;"',
    'style="box-sizing: border-box;position: relative;min-height: 1px;padding-left: 15px;padding-right: 15px;float: left;/* width: 333.328125px; */"'
  );
  html = html.replaceAll(
    'style="border-top: 5px solid #DF001D; padding: 0px 15px; height: 300px;"',
    'style="border-top: 5px solid #0091ff; padding: 10px 15px; height: 300px;"'
  );
  html = html.replaceAll(
    '<h1 style="color: black;">',
    '<h2 style="color:black;">'
  );
  html = html.replaceAll(
    '<strong style="box-sizing: border-box;">',
    '<strong style="box-sizing: border-box; font-size:20px">'
  );
  html = html.replaceAll(
    "border-left: 5px solid #ff0000; border-radius: 5px; padding: 5px; box-shadow: 2px 2px 10px #d8d8d8; -webkit-box-shadow: 2px 2px 10px #d8d8d8;",
    "border-left: 5px solid #0091ff; border-radius: 5px; padding: 25px; box-shadow: 2px 2px 10px #d8d8d8; -webkit-box-shadow: 2px 2px 10px #d8d8d8;"
  );
  html = html.replaceAll(
    'style="border-top: 5px solid #DF001D; padding: 0px 15px; height: 260px;"',
    'style="border-top: 5px solid #0091ff; padding: 10px 15px; height: 260px;"'
  );
  html = html.replaceAll(
    'style="border-top: 5px solid #DF001D; padding: 0px 15px; height: 270px;"',
    'style="border-top: 5px solid #0091ff; padding: 10px 15px; height: 260px;"'
  );
  html = html.replaceAll(
    'style="border-top: 5px solid #E60B07; padding: 0px 15px; height: 460px;"',
    'style="border-top: 5px solid #0091ff; padding: 10px 15px; height: 260px;"'
  );
  html = html.replaceAll(
    'style="border-top: 5px solid #DF001D; padding: 0px 15px; height: 310px;"',
    'style="border-top: 5px solid #0091ff; padding: 10px 15px; height: 260px;"'
  );

  return html;
};
</script>

<template>
  }
  <v-container>
    <!-- <v-row v-show="loading">
      <v-col cols="12" align="center">
        <Loader />
      </v-col>
    </v-row> -->

    <!-- <template > -->
    <v-row>
      <!-- dialog -->
      <v-dialog v-model="dialog" width="600px">
        <v-card>
          <div class="times">
            <v-icon
              :size="30"
              icon="mdi-close"
              @click="dialog = false"
            ></v-icon>
          </div>
          <v-img src="/images/2.jpg" height="500px" width="600px" class="zoom-image" />
        </v-card>
      </v-dialog>
      <!-- dialog -->

      <!-- Photos -->
      <v-col cols="12" xs="6" md="6">
        <v-img
          src="/images/2.jpg"
          height="500px"
          class="zoom-image"
          @click="dialog = true"
        />
      </v-col>
      <!-- Photos -->

      <!-- Info product -->
      <v-col cols="12" xs="6" md="6" class="ps-5">
        <h1 style="line-height: 32px">Cerámica de piso</h1>

        <p class="product-description mt-4">
          Medidas: 20x20cm<br />
          Tipo: Mosaico azul SANBORO
          <!-- {{ selectedProduct.description }} -->
        </p>

        <!-- <v-card-text class="mt-3 p-0" >
            <span>Formato: {{ selectedProduct.format }}</span>
          </v-card-text> -->
        <h1 class="mt-3" style="color: black">
          <h2 class="mt-3" style="color: #bd0102">$ 28.05 <sup>Uni</sup></h2>
        </h1>
        <v-card-text class="mt-3 p-0">
          <span>Stock: 200</span>
        </v-card-text>

        <v-row>
          <v-col cols="12" md="8" xl="3" xxl="3">
            <BaseInput
              type="number"
              min="0"
              variant="outlined"
              label="Cantidad"
              v-model="v$.quantity.$model"
              :rules="v$.quantity"
              validationTextType="only-numbers"
            />
          </v-col>
          <v-col cols="12" md="8" xl="5" xxl="3" class="text-center">
            <BaseButton
              width="400"
              class="my-5"
              type="primary"
              title="Agregar al carrito"
              @click="validateForm()"
            />
            <!-- <p
                class="text-red text-left fs-5"
                v-if="selectedProduct.total_existencia <= 0"
              >
                Este producto no cuenta con stock disponible.
              </p> -->
            <!-- <p class="text-red text-left fs-5" v-if="!isLoggedIn">
                Debes
                <a
                  href="#"
                  class="text-blue"
                  @click="redirectAndGenerateChallenge()"
                  >iniciar sesión</a
                >
                para poder agregar un producto al carrito.
              </p> -->
          </v-col>
        </v-row>
      </v-col>
      <!-- Info product -->

      <!-- Specifications -->
      <v-col cols="12" md="12">
        <h2 class="" style="color: #000c27">Especificaciones</h2>
        <!-- <hr /> -->
      </v-col>

      <v-container>
        <div class="col-12 col-sm-12">
          <v-table>
            <tbody>
              <tr>
                <td>Nombre</td>
                <td>Cerámica de piso</td>
              </tr>
              <tr>
                <td>Tipo</td>
                <td>Mosaico azul SANBORO</td>
              </tr>
              <tr>
                <td>Medidas</td>
                <td>20x20 cm</td>
              </tr>
              <tr>
                <td>Descripción</td>
                <td>Cerámica de piso mosaico, acabado azul semibrillante</td>
              </tr>
              <tr>
                <td>Peso</td>
                <td>1.5 kg</td>
              </tr>
              <!-- <tr
                  v-if="
                    selectedProduct.downloads &&
                    selectedProduct.downloads.length > 0
                  "
                >
                  <td>Descargas</td>
                  <td>
                    <a
                      class="downloadInfo"
                      target="_blank"
                      v-for="(downloadInfo, index) in selectedProduct.downloads"
                      :key="index"
                      :href="downloadInfo.path"
                      >Especificación {{ downloadInfo.resource }}</a
                    >
                  </td>
                </tr> -->
            </tbody>
          </v-table>
        </div>

        <!-- style="max-width: 300px" -->
        <!-- {{ selectedProduct.descripcion }} -->
        <!-- <v-row> -->
        <!-- <p class="mt-5" v-html="convertHtml(selectedProduct.descripcion)"></p> -->
        <!-- </v-row> -->
      </v-container>
    </v-row>
    <!-- </template> -->
  </v-container>
</template>

<style scoped>
.product-description {
  color: #787979;
  font-size: 16px;
}

.zoom-image {
  cursor: pointer;
}

.times {
  padding: 8px;
  display: flex;
  justify-content: flex-end;
}

img {
  width: 100%;
  height: auto;
}

.downloadInfo {
  color: rgb(73, 73, 229);
  text-decoration: underline;
}
</style>
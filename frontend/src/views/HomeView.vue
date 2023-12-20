<script setup>
import { onMounted, ref } from "vue";

import PreviewProduct from "../components/products/ProductView.vue";
import Deal from "@/components/shop/Deal.vue";
import Loader from "@/components/base-components/Loader.vue";

// import epcomApi from "@/services/epcomApi";
// import DealFooter from "../components/shop/DealFooter.vue";
import useProduct from "../composables/useProduct";
import BaseButton from "../components/base-components/BaseButton.vue";

const {
  productInfo,
  selectedCategory,
  loading,
  page,
  totalPages,
  search,
  filterActive,
  getProductsByCategory,
} = useProduct();
</script>

<template>
  <div>
    <!-- Blocks Section -->
    <section class="blocks-section" id="categories">
      <!-- Module -->
      <div class="module-content-d">
        <h2 class="module-title">Cerámica</h2>
        <p class="module-text text-white mb-1">
          Lorem ipsum amet consectetur elit <br />
          amet adipisicing
        </p>
      </div>
      <!-- /.Module -->

      <!-- Module -->
      <div class="module-content-b">
        <h2 class="module-title text-primary-blue">Cuarzo</h2>
        <p class="module-text text-primary-blue mb-1">
          Lorem ipsum dolor sit, onsectetur adipisicing elit <br />
          onsectetur adipisicing elit
        </p>
      </div>
      <!-- /.Module -->
      <!-- Module -->
      <div class="module-content-c">
        <h2 class="module-title text-primary-blue">Porcelanato</h2>
        <p class="module-text mb-0">Consectetur adipisicing elit</p>
      </div>
      <!-- /.Module -->
      <!-- Module -->
      <div class="module-content-a">
        <h2 class="module-title">Azulejo</h2>
        <p class="module-text">
          Lorem ipsum dolor sit <br />amet consectetur adipisicing elit
        </p>
      </div>
      <!-- /.Module -->
      <!-- Module -->
      <div class="module-content-e">
        <h2 class="module-title">Piedras</h2>
        <p class="module-text">
          Lorem ipsum dolor sit <br />amet consectetur adipisicing elit
        </p>
      </div>
      <!-- /.Module -->
      <!-- Module -->
      <div class="module-content-f">
        <h2 class="module-title">Granito</h2>
        <p class="module-text mb-0">Lorem ipsum dolor sit</p>
      </div>
      <!-- /.Module -->
    </section>
    <!-- /.Blocks Section -->

    <!-- Sale Banner -->
    <div class="shop-banner">
      <div class="shop-banner-item">
        <p class="shop-banner-title">Nuestra Tienda En Línea,</p>

        <p class="shop-banner-subtitle">
          Officiis tenetur delectus nisi ipsum, nesciunt tempore provident?
        </p>
      </div>
    </div>
    <!-- /.Sale Banner -->
    <!-- Carousel -->
    <!-- <Deal /> -->
    <!-- Carousel -->

    <v-container>
      <v-row>
        <!-- Title -->

        <!-- Title -->

        <!-- Button filter -->
        <!-- <v-col cols="12">
          <BaseButton
            prepend-icon="mdi-filter-remove"
            type="primary"
            title="Eliminar filtro"
            style="background-color: #BD0102;"
          />
        </v-col> -->
        <!-- Button filter -->
        <v-col cols="12" md="12" ref="textCategory">
          <h1 class="text-black mt-4 mb-3">CATEGORÍAS</h1>
        </v-col>

        <!-- Pagination -->
        <v-col cols="12" align="center">
          <VPagination class="text-black" v-model="page" length="4" rounded="8" />
        </v-col>
        <!-- Pagination -->

        <v-col class="" cols="12" sm="6" md="3" lg="3">
          <v-card class="shadow my-1" :ripple="false">
            <v-img src="/images/2.jpg" height="200px"></v-img>
            <v-card-item>
              <div class="d-flex justify-space-between">
                <h3>Cerámica de piso</h3>
              </div>

              <v-card-text class="mt-3 p-0">
                <span><b>Tipo: </b> Alcala azul HISPACENSA</span>
                <br />
                <span><b>Medidas: </b> 33x33cm</span>
                <h2 class="mt-3" style="color: #bd0102">
                  $ 1.05 <sup>Uni</sup>
                </h2>
              </v-card-text>
            </v-card-item>
            <v-card-actions class="d-flex flex-column">
              <base-button class="w-100 mx-0" type="primary" title="Ver producto" href="/preview/product/" />
            </v-card-actions>
          </v-card>
        </v-col>
        <v-col class="" cols="12" sm="6" md="3" lg="3">
          <v-card class="shadow my-1" :ripple="false">
            <v-img src="/images/1.jpg" height="200px"></v-img>
            <v-card-item>
              <div class="d-flex justify-space-between">
                <h3>Cerámica de piso</h3>
              </div>

              <v-card-text class="mt-3 p-0">
                <span><b>Tipo: </b> Mosaico azul SAMBORO</span>
                <br />
                <span><b>Medidas: </b> 33x33cm</span>
                <h2 class="mt-3" style="color: #bd0102">
                  $ 1.05 <sup>Uni</sup>
                </h2>
              </v-card-text>
            </v-card-item>
            <v-card-actions class="d-flex flex-column">
              <base-button class="w-100 mx-0" type="primary" title="Ver producto" />
            </v-card-actions>
          </v-card>
        </v-col>
        <v-col class="" cols="12" sm="6" md="3" lg="3">
          <v-card class="shadow my-1" :ripple="false">
            <v-img src="/images/3.jpg" height="200px"></v-img>
            <v-card-item>
              <div class="d-flex justify-space-between">
                <h3>Porcelanato</h3>
              </div>

              <v-card-text class="mt-3 p-0">
                <span><b>Tipo: </b> Urban cinder</span>
                <br />
                <span><b>Medidas: </b> 60x60cm</span>
                <h2 class="mt-3" style="color: #bd0102">
                  $ 28.05 <sup>Uni</sup>
                </h2>
              </v-card-text>
            </v-card-item>
            <v-card-actions class="d-flex flex-column">
              <base-button class="w-100 mx-0" type="primary" title="Ver producto" />
            </v-card-actions>
          </v-card>
        </v-col>
        <v-col class="" cols="12" sm="6" md="3" lg="3">
          <v-card class="shadow my-1" :ripple="false">
            <v-img src="/images/5.jpg" height="200px"></v-img>
            <v-card-item>
              <div class="d-flex justify-space-between">
                <h3>Cerámica de piso</h3>
              </div>

              <v-card-text class="mt-3 p-0">
                <span><b>Tipo: </b> Alabama marron HISPACENSA</span>
                <br />
                <span><b>Medidas: </b> 33x33cm</span>
                <h2 class="mt-3" style="color: #bd0102">
                  $ 1.01 <sup>Uni</sup>
                </h2>
              </v-card-text>
            </v-card-item>
            <v-card-actions class="d-flex flex-column">
              <base-button class="w-100 mx-0" type="primary" title="Ver producto" />
            </v-card-actions>
          </v-card>
        </v-col>
        <!-- Pagination -->
        <v-col cols="12" align="center" class="mt-4">
          <VPagination class="text-black" length="4" rounded="8" />
        </v-col>
        <!-- Pagination -->

        <!-- <template> -->
        <!-- Products -->
        <!-- <v-col class="" cols="12" sm="6" md="4" lg="3">
            <preview-product class="h-100" />
          </v-col> -->

        <!-- <v-col cols="12" class="text-center" v-if="productInfo.length == 0">
            <h3>No se encontraron productos.</h3>
          </v-col> -->
        <!-- Products -->

        <!-- </template> -->
        <!-- <Loader v-else /> -->

        <!-- Brands -->
        <!-- <v-col cols="12" md="12" sm="12">
          <DealFooter />
        </v-col> -->
        <!-- Brands -->
      </v-row>
    </v-container>
  </div>
</template>

<style scoped>
.pagination {
  margin: 3.5rem 0;
}
</style>

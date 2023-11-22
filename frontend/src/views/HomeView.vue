<script setup>
import { onMounted, ref } from "vue";

import PreviewProduct from "../components/products/ProductView.vue";
import Deal from "@/components/shop/Deal.vue";
import Loader from "@/components/base-components/Loader.vue";

// import epcomApi from "@/services/epcomApi";
import DealFooter from "../components/shop/DealFooter.vue";
import useProduct from "../composables/useProduct";
import BaseButton from "../components/base-components/BaseButton.vue";

const { productInfo, selectedCategory, loading, page, totalPages, search, filterActive, getProductsByCategory } = useProduct();
</script>

<template>
  <div>
    <!-- Blocks Section -->
    <section class="blocks-section" id="categories">
      <!-- Module -->
      <div class="module-content-d">
        <h2 class="module-title">Piso</h2>
        <p class="module-text text-white mb-1">
          Lorem ipsum amet consectetur elit <br> amet adipisicing
        </p>
      </div>
      <!-- /.Module -->

      <!-- Module -->
      <div class="module-content-b">
        <h2 class="module-title text-primary-blue">Madera</h2>
        <p class="module-text text-primary-blue mb-1">
          Lorem ipsum dolor sit, onsectetur adipisicing elit <br>
          onsectetur adipisicing elit
        </p>
      </div>
      <!-- /.Module -->
      <!-- Module -->
      <div class="module-content-c">
        <h2 class="module-title text-primary-blue">Porcelanato</h2>
        <p class="module-text mb-0">
          Consectetur adipisicing elit
        </p>
      </div>
      <!-- /.Module -->
      <!-- Module -->
      <div class="module-content-a">
        <h2 class="module-title">Azulejo</h2>
        <p class="module-text">
          Lorem ipsum dolor sit <br>amet consectetur adipisicing elit
        </p>
      </div>
      <!-- /.Module -->
      <!-- Module -->
      <div class="module-content-e">
        <h2 class="module-title">Mosaico</h2>
        <p class="module-text">
          Lorem ipsum dolor sit <br>amet consectetur adipisicing elit
        </p>
      </div>
      <!-- /.Module -->
      <!-- Module -->
      <div class="module-content-f">
        <h2 class="module-title">Granito</h2>
        <p class="module-text mb-0">
          Lorem ipsum dolor sit
        </p>
      </div>
      <!-- /.Module -->
    </section>
    <!-- /.Blocks Section -->

    <!-- Sale Banner -->
    <div class="shop-banner">
      <div class="shop-banner-item">
        <p class="shop-banner-title">Dictum Amet Praesent Lacus,<span class="fw-normal"> Est Lsac
            Loremtes</span>
        </p>

        <p class="shop-banner-subtitle">Officiis tenetur delectus nisi ipsum, nesciunt
          tempore provident?</p>
        <a href="#" class="btn-shop">TIENDA EN LÍNEA</a>
      </div>
    </div>
    <!-- /.Sale Banner -->
    <!-- Carousel -->
    <!-- <Deal /> -->
    <!-- Carousel -->

    <v-container>
      <v-row>
        <!-- <v-col cols="12" md="12">
          <h3 class="gradient-title white pt-4">
            <span id="titleStore">Tienda en línea</span>
          </h3>
        </v-col> -->

        <!-- Title -->
        <v-col cols="12" md="12" v-if="selectedCategory && search == ''" ref="textCategory">
          <h1 class="text-black mt-0 mb-3">{{ selectedCategory.name }}</h1>
        </v-col>
        <!-- Title -->

        <!-- Button filter -->
        <v-col cols="12" v-if="filterActive">
          <BaseButton prepend-icon="mdi-filter-remove" type="primary" title="Eliminar filtro"
            @click="getProductsByCategory(selectedCategory);" />
        </v-col>
        <!-- Button filter -->

        <!-- Pagination -->
        <v-col cols="12" align="center" v-if="totalPages > 1">
          <VPagination class="text-black" v-model="page" :length="totalPages" :total-visible="3" rounded="8" />
        </v-col>
        <!-- Pagination -->

        <template v-if="!loading">
          <!-- Products -->
          <v-col class="" cols="12" sm="6" md="4" lg="3" v-for="(product, index) in productInfo" :key="index">
            <preview-product class="h-100" :product="product" />
          </v-col>

          <v-col cols="12" class="text-center" v-if="productInfo.length == 0">
            <h3>No se encontraron productos.</h3>
          </v-col>
          <!-- Products -->

          <!-- Pagination -->
          <v-col cols="12" align="center" class="mt-4" v-if="totalPages > 1">
            <VPagination class="text-black" v-model="page" :length="totalPages" :total-visible="3" rounded="8" />
          </v-col>
          <!-- Pagination -->

        </template>
        <Loader v-else />

        <!-- Brands -->
        <v-col cols="12" md="12" sm="12">
          <DealFooter />
        </v-col>
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

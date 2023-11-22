<script setup>
import { onMounted } from "vue";

import Loader from "@/components/base-components/Loader.vue";

import useStoreCarousel from "@/composables/useStoreCarousel";
import useAuth from "@/composables/useAuth";

const { carousels, loadingCarousel, getCarousel } = useStoreCarousel();

onMounted(getCarousel);
</script>
<template>
  <v-container>
    <v-row>
      <v-col cols="12" md="12" v-if="!loadingCarousel">
        <!-- Carousel -->
        <v-carousel
          cycle
          style="max-width: 100%"
          height="auto"
          hide-delimiters
          show-arrows="hover"
        >
          <v-carousel-item
            :src="item.image_url"
            v-for="(item, i) in carousels"
            :key="i"
          />
        </v-carousel>
        <!-- Carousel -->
      </v-col>
      <Loader v-else />
    </v-row>
  </v-container>
</template>
<!-- <script>
export default {
  data() {
    return {
      images: [
        "banners/banner1.jpg",
        "banners/banner2.jpg",
        "banners/banner3.jpg",
        "banners/banner4.jpg",
        "banners/banner5.jpg",
        "banners/banner6.jpg",
        "banners/banner7.jpg",
        "banners/banner8.png",
      ],
    };
  },
};
</script> -->

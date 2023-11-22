<template>
  <v-container>
    <div id="map" ref="map"></div>
  </v-container>
</template>
  
<script setup>
import useLocation from "@/composables/useLocation";

useLocation();
</script>
  
  <style scoped>
* {
  z-index: 0;
}

#map {
  width: 100%;
  height: 400px;
  /* background: yellowgreen; */
}
</style>
<script setup>
import { ref, onMounted } from "vue";
import { useRouter } from "vue-router";

import Loader from "@/components/base-components/Loader.vue";

import useStoreOrder from "@/composables/useStoreOrder";

const { orders, loadingOrder, total, getOrders } = useStoreOrder();

onMounted(getOrders);
</script>
<template>
  <v-container>
    <v-row>
      <v-col cols="12" md="12" sm="12" lg="12">
        <!-- Sale Banner -->
        <div class="shop-banner">
          <div class="shop-banner-item">
            <p class="shop-banner-title">
              Mis Pedidos
              <!-- <span class="fw-normal"> Est Lsac Loremtes</span> -->
            </p>

            <p class="shop-banner-subtitle">
              Aqui encontrarás todos tus pedidos realizados
            </p>
            <!-- <a href="#" class="btn-shop">TIENDA EN LÍNEA</a> -->
          </div>
        </div>
        <!-- /.Sale Banner -->
      </v-col>
    </v-row>
    <v-row class="" v-if="!loadingOrder">
      <v-col cols="12" md="12" sm="12" v-if="orders.length > 0">
        <div class="order-card mt-5" v-for="(order, index) in orders" :key="index">
          <div class="order-card-header">
            <div class="order-card-header-item">
              <p class="text-uppercase">
                <span class="fw-bold">Pedido realizado</span> <br />
                {{ order.created_at }}
              </p>
              <p class="text-uppercase">
                <span class="fw-bold">Total</span> <br />
                ${{ order.subtotal }}
              </p>
              <p class="text-uppercase">
                <span class="fw-bold">Estado</span> <br />
                {{ order.state.name }}
              </p>
              <!-- <p class="text-uppercase">
                <span class="fw-bold">Fecha de actualización</span> <br />
                {{ order.state.created_at }}
              </p> -->
            </div>
            <div class="order-card-header-item">
              <p class="text-uppercase">
                <span class="fw-bold">PEDIDO N.º</span> {{ index + 1 }}
              </p>
            </div>
          </div>

          <!-- {{ order.cart }} -->
          <div class="order-card-body">
            <v-table>
              <thead>
                <tr class="text-center">
                  <th>Producto</th>
                  <th>Cantidad</th>
                  <th>Precio</th>
                  <th>Subtotal</th>
                </tr>
              </thead>

              <tbody>
                <tr class="text-left" v-for="(detail, detailIndex) in order.cart" :key="detailIndex">
                  <td style="max-width: 300px">
                    <v-row class="my-auto">
                      <v-col cols="12" sm="12" md="4" class="pe-0">
                        <v-img class="mx-auto" :src="detail.product.img_portada" width="150" height="150"></v-img>
                      </v-col>
                      <v-col cols="12" sm="12" md="7" class="p-0 my-auto">
                        <b>
                          {{ detail.product.producto_id }} -
                          {{ detail.product.titulo }}
                        </b>
                      </v-col>
                    </v-row>
                  </td>
                  <td>{{ detail.quantity }}</td>
                  <td>${{ detail.price }}</td>
                  <td>${{ (detail.quantity * detail.price).toFixed(2) }}</td>
                </tr>
              </tbody>
            </v-table>
          </div>
        </div>
      </v-col>
      <v-col cols="12" md="12" sm="12" align="center" v-else>
        <v-icon icon="mdi-package-variant mb-4" :size="56"></v-icon>
        <h1 class="text-center mb-5" style="line-height: 28px">
          Aún no hay pedidos registrados.
        </h1>
      </v-col>
    </v-row>
    <v-row v-else align="center">
      <Loader />
    </v-row>
  </v-container>
</template>

<style scoped>
.order-card {
  border: 1px solid #ccc;
  border-radius: 8px 8px 0 0;
}

.order-card-header {
  padding: 15px;
  background-color: #f0f2f2;
  display: flex;
  justify-content: space-between;
  font-weight: 500;
  font-size: 14px;
}

.order-card-header-item {
  display: flex;
  gap: 20px;
}
</style>

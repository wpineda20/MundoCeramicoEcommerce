<script setup>
import useAuth from "@/composables/useAuth";
import useCart from "@/composables/useCart";
import useProduct from "@/composables/useProduct";

import { RouterLink } from "vue-router";
import useMenu from "@/composables/useMenu";
import { onMounted, ref } from "vue";
import { toast } from "vue3-toastify";

const { stateSideBar } = useMenu();

const { products, calculateSubtotal } = useCart();
const { user, isLoggedIn, logout } = useAuth();
const {
  productInfo,
  categories,
  getCategories,
  getProductsByCategory,
  selectedCategory,
  loading,
  search,
  searchProducts,
} = useProduct();
const { redirectAndGenerateChallenge } = useAuth();

const registerUrl = ref(import.meta.env.VITE_BACKEND_URL + "/register");
const homeUrl = ref(import.meta.env.VITE_BACKEND_URL + "/home");

onMounted(() => {
  initialize();
});

const initialize = async () => {
  try {
    if (localStorage.getItem("products")) {
      products.value = JSON.parse(localStorage.getItem("products"));
      calculateSubtotal();
    }

    if (categories.value.length == 0) {
      loading.value = true;
      await getCategories();

      if (categories.value.length > 0) {
        // selectedCategory.value = categories.value[0];
        selectedCategory.value = categories.value.filter(
          (cat) => cat.name == "Bala"
        )[0];
      }
    }

    if (productInfo.value.length == 0) {
      await getProductsByCategory(selectedCategory.value);
    }
    loading.value = false;
  } catch (error) {
    toast.error(error.message);
    console.error(error);
  }
};
</script>

<template>
  <header class="header style7" id="header">
    <div class="header-device-mobile">
      <div class="wapper">
        <!-- logo mobile -->
        <div class="item mobile-logo">
          <div class="logo">
            <!-- <RouterLink to="/">
              <img
                src="/logos/logo_azul_negro_rombo_rojo.png"
                alt="logo mundo ceramico"
                height="40"
              />
            </RouterLink> -->
          </div>
        </div>
        <!-- logo mobile -->
        <!-- menu -->
        <div class="item mobile-menu-box has-sub">
          <a href="#" @click="stateSideBar = 'active'">
            <span class="icon">
              <v-icon
                style="color: #000c27"
                icon="mdi-menu"
                :size="30"
              ></v-icon>
            </span>
          </a>
        </div>
        <!-- menu -->
      </div>
      <!-- search -->
      <!-- <div class="wapper pt-3">
          <div class="block-search-block w-100">
            <div class="form-search form-search-width-category">
              <div class="form-content my-2" style="max-width: 100%">
                <div class="inner">
                  <input type="text" class="input py-0" @keyup.enter="searchProducts" v-model="search" />
                </div>
                <btn type="submit" class="btn-search text-center" href="#" @click="searchProducts">
                  <v-icon class="m-0" icon="mdi-magnify" :size="26"></v-icon>
                </btn>
              </div>
            </div>
          </div>
        </div> -->
      <!-- search -->
      <!-- <div class="wapper pt-3">
          <div class="header-nav-wapper main-menu-wapper">
            <div class="vertical-wapper block-nav-categori">
              <div class="block-title">
                <span class="icon-bar">
                  <span></span>
                  <span></span>
                  <span></span>
                </span>
                <span class="text">Categorías</span>
              </div>
              <div class="block-content verticalmenu-content">
                <ul class="zentimo-nav-vertical vertical-menu zentimo-clone-mobile-menu" v-if="categories.length > 0">
                  <li class="menu-item" v-for="category in categories" :key="category.id">
                    <a href="#" class="zentimo-menu-item-title" :title="category.name"
                      @click="getProductsByCategory(category, redirect = true)">{{ category.name }}</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div> -->
    </div>
    <div class="top-bar">
      <div class="navbar">
        <v-container class="pt-1 pb-1">
          <ul class="navbar-nav">
            <li class="nav-item">
              <RouterLink to="/" class="">
                <a class="nav-link nav-titles">Inicio</a>
              </RouterLink>
            </li>
            <li class="nav-item">
              <RouterLink to="/about" class="">
                <a class="nav-link nav-titles">Nosotros</a>
              </RouterLink>
            </li>
            <li class="nav-item">
              <RouterLink to="/services" class="">
                <a class="nav-link nav-titles">Servicios</a>
              </RouterLink>
            </li>

            <li class="nav-item">
              <RouterLink to="/contact" class="">
                <a class="nav-link nav-titles">Contacto</a>
              </RouterLink>
            </li>

            <li class="nav-item">
              <RouterLink to="/tips" class="">
                <a class="nav-link nav-titles">TIPs</a>
              </RouterLink>
            </li>

            <li class="nav-item" v-if="!isLoggedIn">
              <a class="nav-link nav-titles" :href="registerUrl">Registrarme</a>
            </li>
            <li class="nav-item" v-if="!isLoggedIn">
              <a
                class="nav-link nav-titles"
                @click="redirectAndGenerateChallenge()"
                >Iniciar sesión</a
              >
            </li>

            <li class="nav-item" v-if="isLoggedIn">
              <v-menu>
                <template v-slot:activator="{ props }">
                  <a class="nav-link nav-titles" dark v-bind="props">
                    Cuenta
                  </a>
                </template>
                <v-card min-width="100" style="border-radius: 0px !important">
                  <v-list
                    style="
                       background-color: rgba(22, 22, 23, .8); !important;
                      padding: 0 !important;
                    "
                  >
                    <v-list-item>
                      <a
                        class="nav-link nav-titles"
                        style="padding: 0 !important"
                        :href="registerUrl"
                      >
                        <v-list-item-title
                          ><b>{{ user.name }}</b></v-list-item-title
                        >
                      </a>
                    </v-list-item>
                  </v-list>
                  <v-divider></v-divider>
                  <v-list
                    style="
                       background-color: rgba(22, 22, 23, .8); !important;
                      padding: 0 !important;
                    "
                  >
                    <v-list-item>
                      <a
                        class="nav-link nav-titles"
                        style="padding: 0 !important"
                        :href="homeUrl"
                        taget="_blank"
                      >
                        <v-list-item-title>Mi Cuenta</v-list-item-title>
                      </a>
                    </v-list-item>
                    <v-list-item>
                      <RouterLink to="/myOrders" class="">
                        <a
                          class="nav-link nav-titles"
                          style="padding: 0 !important"
                        >
                          <v-list-item-title>Mis Pedidos</v-list-item-title>
                        </a>
                      </RouterLink>
                    </v-list-item>
                    <v-list-item>
                      <a
                        class="nav-link nav-titles"
                        style="padding: 0 !important"
                      >
                        <v-list-item-title @click="logout()"
                          >Cerrar sesión</v-list-item-title
                        >
                      </a>
                    </v-list-item>
                  </v-list>
                </v-card>
              </v-menu>
            </li>

            <li
              class="nav-item"
              style="display: flex; align-items: center"
              v-if="isLoggedIn"
            >
              <RouterLink to="/cart">
                <v-badge :content="products.length" color="error">
                  <v-icon
                    style="color: #fff !important"
                    class="m-0"
                    icon="mdi-cart"
                  >
                  </v-icon>
                </v-badge>
              </RouterLink>
            </li>
          </ul>
        </v-container>
      </div>
    </div>

    <!-- <v-container class="pt-0 pb-0 m-0 mx-auto">
      <div class="main-header">
        <v-row class="w-100 m-0"> -->
    <!-- Search -->
    <!-- <v-col cols="12" sm="6" md="6" lg="6" class="my-auto">
            <div class="block-search-block">
              <div class="form-search form-search-width-category">
                <div class="form-content">
                  <div class="inner">
                    <input type="text" class="input" v-model="search" @keyup.enter="searchProducts"
                      placeholder="Buscar" />
                  </div>
                  <btn type="submit" class="btn-search text-center" @click="searchProducts">
                    <v-icon class="m-0" icon="mdi-magnify"></v-icon>
                  </btn>
                </div>
              </div>
            </div>
          </v-col> -->
    <!-- Search -->

    <!-- Cart and user -->
    <!-- <v-col cols="12" sm="3" md="3" lg="3" class="my-auto">
            <div class="header-control d-flex flex-row justify-center">
              <div class="block-account block-header zentimo-dropdown" v-if="isLoggedIn">
                <div class="header-account zentimo-submenu m-0">
                  <div class="header-user-form-tabs">
                    <div class="tab-container">
                      <div id="header-tab-login" class="tab-panel active">
                        <div class="login form-login px-5 py-3">

                          <p class="form-row">
                            <a href="#" class="button" @click="logout()">Cerrar sesión</a>
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </v-col>
        </v-row>
      </div>
    </v-container> -->

    <!-- Header Content -->
    <div class="container">
      <div class="header-items">
        <!-- Header Titles -->
        <div class="header-text">
          <a class="header-logo" href="{{ url('/') }}">
            <img
              src="logos/logo_azul_negro_rombo_rojo_.png"
              class="text-center"
              alt="logo mundo ceramico"
              width="220"
              height="90"
            />
          </a>
          <h1 class="h-title">
            <span class="text-primary-red">MUNDO</span> CERÁMICO
          </h1>
          <h2 class="h-subtitle">
            Lorem ipsum dolor sit amet elit. <br />
            sit amet consectetur adipisicing consectetur.
          </h2>
          <div class="d-flex">
            <a href="#categories" class="btn-header mx-auto"
              >Explorar Más
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="16"
                height="16"
                fill="currentColor"
                class="bi bi-chevron-right"
                viewBox="0 0 16 16"
              >
                <path
                  fill-rule="evenodd"
                  d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"
                />
              </svg>
            </a>
          </div>
        </div>
        <!-- /.Header Titles -->
      </div>
    </div>
    <!-- /.Header Content -->
  </header>
</template>

<style lang="scss">
@import "@/assets/styles/variables.scss";

.menu-sidebar {
  width: 6rem;
  height: 100vh;
  position: fixed;
  top: 0;
  z-index: 1;
  background: $menu-color;
  font-size: 16px;
}

.menu-sidebar a {
  color: white;
}

.inactive {
  left: -6rem;
  animation: linear;
  animation-name: hideMenu;
  animation-duration: 0.4s;
}

@keyframes hideMenu {
  0% {
    left: 0;
    transform: translateX(0);
  }

  100% {
    left: -6rem;
    transform: translateX(-6rem);
  }
}

.active {
  left: 0;
  animation: linear;
  animation-name: showMenu;
  animation-duration: 0.4s;
}

@keyframes showMenu {
  0% {
    left: -6rem;
    transform: translateX(-6rem);
  }

  100% {
    left: 0;
    transform: translateX(0);
  }
}

.verticalmenu-content {
  max-height: 400px;
  overflow-y: scroll;
}

.v-menu > .v-overlay__content > .v-card,
.v-menu > .v-overlay__content > .v-sheet,
.v-menu > .v-overlay__content > .v-list {
  background: #fff !important;
  padding: 0px !important;
}

.v-list-item--density-default.v-list-item--one-line {
  min-height: 35px !important;
}

.none-btn:hover {
  background-color: transparent !important;
}
</style>
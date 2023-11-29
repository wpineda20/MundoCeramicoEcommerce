import { createRouter, createWebHistory } from "vue-router";
import NotFoundView from "@/views/NotFoundView.vue";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: "/login",
      name: "login",
      component: () => import("@/views/LoginView.vue"),
    },
    {
      path: "/redirectToProvider",
      name: "redirectToProvider",
      component: () => import("@/views/RedirectToProviderView.vue"),
    },
    {
      path: "/callback",
      name: "callback",
      component: () => import("@/views/CallbackView.vue"),
    },
    {
      path: "/",
      name: "home",
      component: () => import("@/views/HomeView.vue"),
      // meta: { requiresAuth: true }, // add meta field to specify the route requires authentication
    },
    {
      path: "/test",
      name: "test",
      component: () => import("@/views/TestView.vue"),
      // meta: { requiresAuth: true }, // add meta field to specify the route requires authentication
    },
    {
      path: "/department",
      name: "department",
      component: () => import("@/views/DepartmentView.vue"),
      // meta: { requiresAuth: true }, // add meta field to specify the route requires authentication
    },
    {
      path: "/preview/product/",
      name: "previewProduct",
      component: () => import("@/views/products/PreviewProduct.vue"),
      meta: {
        breadCrumb: [
          {
            title: 'Inicio',
            path: '/',
          },
          {
            title: 'Producto',
          }
        ]
      }
    },
    {
      path: "/cart",
      name: "cart",
      component: () => import("@/views/products/CartView.vue"),
      meta: {
        requiresAuth: true,
        breadCrumb: [
          {
            title: 'Inicio',
            path: '/',
          },
          {
            title: 'Carrito',
          }
        ]
      }
    },
    {
      path: "/buy",
      name: "buy",
      component: () => import("@/views/products/BuyView.vue"),
      meta: {
        requiresAuth: true,
      }
    },
    {
      path: "/thanks",
      name: "thanks",
      component: () => import("@/views/ThankView.vue"),
      meta: {
        requiresAuth: true,
      }
    },
    {
      path: "/:pathMatch(.*)*",
      name: "NotFound",
      component: NotFoundView,
    },
    {
      path: "/about",
      name: "about",
      component: () => import("@/views/AboutView.vue"),
    },
    {
      path: "/contact",
      name: "contact",
      component: () => import("@/views/ContactView.vue"),
    },
    {
      path: "/services",
      name: "services",
      component: () => import("@/views/ServicesView.vue"),
    },
    {
      path: "/myOrders",
      name: "myOrders",
      component: () => import("@/views/MyOrderView.vue"),
      meta: {
        requiresAuth: true,
      }
    },
  ],

  scrollBehavior(to, from, savedPosition) {
    if (to.name == 'home') {
      return {
        el: '#titleStore',
        top: 20
      }
    }
    return { top: 0 };
  },
});

// add a global beforeEnter guard to check if the route requires authentication and if the user has an access token
router.beforeEach((to, from, next) => {
  if (to.meta.requiresAuth && !hasAccessToken()) {
    next("/login");
  } else {
    next();
  }
});

// helper function to check if the user has an access token
function hasAccessToken() {
  const token = localStorage.getItem("access_token");
  return token !== null && token !== undefined;
}

export default router;

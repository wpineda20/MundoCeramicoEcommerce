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
      meta: { requiresAuth: true }, // add meta field to specify the route requires authentication
    },
    {
      path: "/:pathMatch(.*)*",
      name: "NotFound",
      component: NotFoundView,
    },
    {
      path: "/order",
      name: "order",
      component: () => import("@/components/administration/OrderView.vue"),
      meta: { requiresAuth: true },
    },
    {
      path: "/state",
      name: "state",
      component: () => import("@/components/administration/StateView.vue"),
      meta: { requiresAuth: true },
    },
    {
      path: "/user",
      name: "user",
      component: () => import("@/components/administration/UserView.vue"),
      meta: { requiresAuth: false },
    },
    {
      path: "/localization",
      name: "localization",
      component: () =>
        import("@/components/administration/StoreView.vue"),
      meta: { requiresAuth: true },
    },
    // {
    //   path: "/store",
    //   name: "store",
    //   component: () => import("@/components/administration/StoreView.vue"),
    //   meta: { requiresAuth: true },
    // },
    {
      path: "/carousel",
      name: "carousel",
      component: () => import("@/components/administration/CarouselView.vue"),
      meta: { requiresAuth: true },
    },
  ],

  scrollBehavior() {
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

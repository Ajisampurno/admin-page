import DashboardLayout from "@/layout/dashboard/DashboardLayout.vue";
// GeneralViews
import NotFound from "@/pages/NotFoundPage.vue";

// Admin pages
import Dashboard from "@/pages/Dashboard.vue";
import UserProfile from "@/pages/UserProfile.vue";
import ManageUser from "@/pages/ManageUser.vue";
import Order from "@/pages/Orders/Order.vue";
import CreateOrder from "@/pages/Orders/CreateOrder.vue";
import EditOrder from "@/pages/Orders/EditOrder.vue";
import Product from "@/pages/Products/Product.vue";
import CreateProduct from "@/pages/Products/CreateProduct.vue";
import EditProduct from "@/pages/Products/EditProduct.vue";
import Categorie from "@/pages/Categories/Categorie.vue";
import CreateCategorie from "@/pages/Categories/CreateCategorie.vue";
import EditCategorie from "@/pages/Categories/EditCategorie.vue";

const routes = [
  {
    path: "/",
    component: DashboardLayout,
    redirect: "/dashboard",
    children: [
      {
        path: "dashboard",
        name: "dashboard",
        component: Dashboard,
      },
      {
        path: "user",
        name: "user",
        component: UserProfile,
      },
      {
        path: "manage-user",
        name: "manage-user",
        component: ManageUser,
      },
      {
        path: "product",
        name: "product",
        component: Product,
      },
      {
        path: "order",
        name: "order",
        component: Order,
      },
      {
        path: "create-order",
        name: "create-order",
        component: CreateOrder,
      },
      {
        path: "edit-order/:id",
        name: "edit-order",
        component: EditOrder,
      },
      {
        path: "product",
        name: "product",
        component: Product,
      },
      {
        path: "create-product",
        name: "create-product",
        component: CreateProduct,
      },
      {
        path: "edit-product/:id",
        name: "edit-product",
        component: EditProduct,
      },
      {
        path: "categorie",
        name: "categorie",
        component: Categorie,
      },
      {
        path: "create-categorie",
        name: "create-categorie",
        component: CreateCategorie,
      },
      {
        path: "edit-categorie/:id",
        name: "edit-categorie",
        component: EditCategorie,
      },
    ],
  },
  { path: "*", component: NotFound },
];

/**
 * Asynchronously load view (Webpack Lazy loading compatible)
 * The specified component must be inside the Views folder
 * @param  {string} name  the filename (basename) of the view to load.
function view(name) {
   var res= require('../components/Dashboard/Views/' + name + '.vue');
   return res;
};**/

export default routes;

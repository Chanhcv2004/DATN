import { createRouter, createWebHistory } from 'vue-router'

import HomePage from '../pages/HomePage.vue'
import AboutPage from '../pages/AboutPage.vue'
import BlogPage from '../pages/BlogPage.vue'
import ContactPage from '../pages/ContactPage.vue'
import CartPage from '../pages/CartPage.vue'
import DetailPage from '../pages/DetailPage.vue'
import FavouritePage from '../pages/FavouritePage.vue'
import LoginPage from '../pages/LoginPage.vue'
import ProductPage from '../pages/ProductPage.vue'
import PayPage from '../pages/PayPage.vue'
import ForgotPassPage from '../pages/ForgotPassPage.vue'
import ResetPass from '../pages/ResetPass.vue'
import PersonalInfo from '../pages/PersonalInfo.vue'
import ChangePassword from '../pages/ChangePassword.vue'

const routes = [
  { path: '/', name: 'home', component: HomePage },
  { path: '/about', name: 'about', component: AboutPage },
  { path: '/blog', name: 'blog', component: BlogPage },
  { path: '/contact', name: 'contact', component: ContactPage },
  { path: '/cart', name: 'cart', component: CartPage },
  { path: '/detail/:id', name: 'detail', component: DetailPage },
  { path: '/favourite', name: 'favourite', component: FavouritePage },
  { path: '/login', name: 'login', component: LoginPage },
  { path: '/product', name: 'product', component: ProductPage },
  { path: '/pay', name: 'pay', component: PayPage },
  { path: '/forgot', name: 'forgotpass', component: ForgotPassPage },
  { path: '/reset-pass', name: 'resetpass', component: ResetPass },
  { path: '/personal-info', name: 'personalinfo', component: PersonalInfo },
  {path: '/change-password', name: 'changepassword', component: ChangePassword},
]
// path: "/admin",
//         component: () => import("../layouts/admin.vue"),
//         children: [
//             {
//                 path: "dashboard",
//                 name: "admin-dashboard",
//                 component: () => import("../pages/admin/dashboard/index.vue")
//             },
const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router

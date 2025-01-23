import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/Home.vue'
import RegisterView from '../views/Register.vue'

const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView
  },
  {
    path: '/register',
    name: 'register',
    component: RegisterView
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
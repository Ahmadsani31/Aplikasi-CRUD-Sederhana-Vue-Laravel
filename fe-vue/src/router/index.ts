import { createRouter, createWebHistory } from 'vue-router'
import type { RouteRecordRaw } from 'vue-router'
import { useAuthStore } from '@/stores/auth'
import authRoutes from './authRoutes'
import dashboardRoutes from './dashboardRoutes'
import mahasiswaRoutes from './mahasiswaRoutes'

const routes: Array<RouteRecordRaw> = [...authRoutes, ...dashboardRoutes, ...mahasiswaRoutes]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

router.beforeEach(async (to, from, next) => {
  const authStore = useAuthStore()
  const isAuthenticated = await authStore.checkToken()

  console.log(isAuthenticated)

  if (to.meta.requiresAuth && !isAuthenticated) {
    next('/login')
  } else if (to.meta.requiresGuest && isAuthenticated) {
    next('/dashboard')
  } else {
    next()
  }
})

export default router

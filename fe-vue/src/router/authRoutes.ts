import type { RouteRecordRaw } from 'vue-router'
import RegisterView from '@/views/auth/RegisterView.vue'
import LoginView from '@/views/auth/LoginView.vue'

const authRoutes: RouteRecordRaw[] = [
  { path: '/', component: LoginView, meta: { requiresGuest: true } },
  { path: '/login', component: LoginView, meta: { requiresGuest: true } },
  { path: '/register', component: RegisterView, meta: { requiresGuest: true } },
]

export default authRoutes

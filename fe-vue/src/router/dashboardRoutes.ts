import type { RouteRecordRaw } from 'vue-router'
import DashboardView from '@/views/dashboard/DashboardView.vue'
import DefaultLayout from '@/layout/DefaultLayout.vue'

const dashboardRoutes: Array<RouteRecordRaw> = [
  {
    path: '/dashboard',
    component: DefaultLayout,
    meta: { requiresAuth: true },
    children: [{ path: '', component: DashboardView }],
  },
]

export default dashboardRoutes

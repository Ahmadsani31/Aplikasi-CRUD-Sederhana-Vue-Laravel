import type { RouteRecordRaw } from 'vue-router'
import MahasiswaIndex from '@/views/mahasiswa/IndexView.vue'
import MahasiswaCreate from '@/views/mahasiswa/CreateView.vue'
import MahasiswaEdit from '@/views/mahasiswa/EditView.vue'
import DefaultLayout from '@/layout/DefaultLayout.vue'

const mahasiswaRoutes: Array<RouteRecordRaw> = [
  {
    path: '/mahasiswa',
    component: DefaultLayout,
    meta: { requiresAuth: true },
    children: [
      { path: '', component: MahasiswaIndex },
      { path: '/mahasiswa/create', component: MahasiswaCreate },
      { path: '/mahasiswa/edit/:id', name: 'mahasiswa-edit', component: MahasiswaEdit },
    ],
  },
]

export default mahasiswaRoutes

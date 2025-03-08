<script setup lang="ts">
import { onMounted, ref } from 'vue'
import axios from 'axios'

import { useAuthStore } from '@/stores/auth'
import { useRoute, useRouter } from 'vue-router'
import API_URL from '@/config'

const authStore = useAuthStore()
const isLoading = ref(false)
const route = useRoute()
const router = useRouter()
interface Mahasiswa {
  id?: number
  user_id?: number
  nim: string
  nama: string
  email: string
  no_handphone: string
  alamat: string
}

const form = ref<Mahasiswa>({
  user_id: authStore.user?.id,
  nim: '',
  nama: '',
  email: '',
  no_handphone: '',
  alamat: '',
})
const errors = ref<{
  nim: string[]
  nama: string[]
  email: string[]
  no_handphone: string[]
  alamat: string[]
}>({
  nim: [],
  email: [],
  nama: [],
  no_handphone: [],
  alamat: [],
})

const fetchMahasiswa = async () => {
  try {
    const token = localStorage.getItem('auth_token')
    const response = await axios.get(`${API_URL}/mahasiswa/edit/${route.params.id}`, {
      headers: { Authorization: `Bearer ${token}` },
    })
    console.log(response)

    form.value = response.data.data
  } catch (error) {
    console.error('Error fetching mahasiswa:', error)
  }
}

const updateMahasiswa = async () => {
  isLoading.value = true
  if (!route.params.id) return
  try {
    const token = localStorage.getItem('auth_token')
    await axios.put(`${API_URL}/mahasiswa/update/${route.params.id}`, form.value, {
      headers: { Authorization: `Bearer ${token}` },
    })
    router.push('/mahasiswa')
  } catch (error: unknown) {
    if (axios.isAxiosError(error)) {
      if (error.response && error.response.data.errors) {
        errors.value = error.response.data.errors
      }
    } else {
      console.error('Unexpected error:', error)
    }
  } finally {
    isLoading.value = false
  }
}

onMounted(() => fetchMahasiswa())
</script>
<template>
  <!-- [ Main Content ] start -->
  <div class="pc-content">
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
      <div class="page-block">
        <div class="row align-items-center">
          <div class="col-md-12">
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><RouterLink to="/dashboard">Home</RouterLink></li>
              <li class="breadcrumb-item" aria-current="page">Mahasiswa</li>
            </ul>
          </div>
          <div class="col-md-12">
            <div class="page-header-title">
              <h2 class="mb-0">Mahasiswa</h2>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- [ breadcrumb ] end -->

    <!-- [ Main Content ] start -->
    <div class="row">
      <!-- [ sample-page ] start -->
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header">
            <h5>Kelola Mahasiswa</h5>
          </div>
          <div class="card-body">
            <form @submit.prevent="updateMahasiswa">
              <div class="form-group">
                <label class="form-label" for="nim">NIM</label>
                <input
                  type="text"
                  class="form-control"
                  :class="{ 'is-invalid': errors.nim?.length > 0 }"
                  v-model="form.nim"
                  id="nim"
                  placeholder="Enter NIM"
                />
                <div class="invalid-feedback">
                  {{ errors.nim[0] }}
                </div>
              </div>
              <div class="form-group">
                <label class="form-label" for="nama">Nama</label>
                <input
                  type="text"
                  class="form-control"
                  :class="{ 'is-invalid': errors.nama?.length > 0 }"
                  v-model="form.nama"
                  id="nama"
                  placeholder="Enter Nama"
                />
                <div class="invalid-feedback">
                  {{ errors.nama[0] }}
                </div>
              </div>
              <div class="form-group">
                <label class="form-label" for="email">Email</label>
                <input
                  type="email"
                  class="form-control"
                  :class="{ 'is-invalid': errors.email?.length > 0 }"
                  v-model="form.email"
                  id="email"
                  placeholder="Enter Email"
                />
                <div class="invalid-feedback">
                  {{ errors.email[0] }}
                </div>
              </div>
              <div class="form-group">
                <label class="form-label" for="handphone">No Handphone</label>
                <input
                  type="text"
                  class="form-control"
                  :class="{ 'is-invalid': errors.no_handphone?.length > 0 }"
                  v-model="form.no_handphone"
                  id="handphone"
                  placeholder="Enter No Handphone"
                />
                <div class="invalid-feedback">
                  {{ errors.no_handphone[0] }}
                </div>
              </div>
              <div class="form-group">
                <label class="form-label" for="alamat">Alamat</label>
                <textarea
                  class="form-control"
                  :class="{ 'is-invalid': errors.alamat?.length > 0 }"
                  v-model="form.alamat"
                  id="alamat"
                  rows="3"
                  placeholder="Enter Alamat"
                ></textarea>
                <div class="invalid-feedback">
                  {{ errors.alamat[0] }}
                </div>
              </div>
              <button type="submit" class="btn btn-primary mb-4">
                <template v-if="isLoading">
                  <div class="spinner-border spinner-border-sm" role="status">
                    <span class="visually-hidden">Loading...</span>
                  </div>
                  Update</template
                >
                <template v-else>Update</template>
              </button>
            </form>
          </div>
        </div>
      </div>
      <!-- [ sample-page ] end -->
    </div>
    <!-- [ Main Content ] end -->
  </div>
</template>

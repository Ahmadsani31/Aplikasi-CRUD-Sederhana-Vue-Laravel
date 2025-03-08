<template>
  <div class="pc-content">
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
      <div class="page-block">
        <div class="row align-items-center">
          <div class="col-md-12">
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><RouterLink to="/dashboard">Home</RouterLink></li>
              <li class="breadcrumb-item" aria-current="page">Home</li>
            </ul>
          </div>
          <div class="col-md-12">
            <div class="page-header-title">
              <h2 class="mb-0">Home</h2>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- [ breadcrumb ] end -->

    <!-- [ Main Content ] start -->
    <div class="row">
      <!-- [ sample-page ] start -->
      <div class="col-sm-9">
        <div class="card">
          <div class="card-body my-2">
            <h3>Selamat Datang {{ authStore.user?.name }}</h3>
          </div>
        </div>
      </div>
      <!-- [ sample-page ] start -->
      <div class="col-md-6 col-xl-3">
        <div class="card">
          <div class="card-body">
            <h6 class="mb-2 f-w-400 text-muted">Total Mahasiswa</h6>

            <template v-if="placeholder">
              <div class="ph-item">
                <div class="ph-row">
                  <div class="ph-col-12"></div>
                </div>
              </div>
            </template>
            <h4 class="mb-3" v-else>{{ countMahasiswa }} mahasiswa</h4>
          </div>
        </div>
      </div>

      <!-- [ sample-page ] end -->
    </div>
    <!-- [ Main Content ] end -->
  </div>
</template>
<script setup lang="ts">
// import { useAuthStore } from '@/stores/auth'
import { RouterLink } from 'vue-router'
import { useAuthStore } from '@/stores/auth'
import axios from 'axios'
import { onMounted, ref } from 'vue'
import API_URL from '@/config'

const countMahasiswa = ref(0)
const placeholder = ref(false)

const authStore = useAuthStore()

const fetchMahasiswa = async () => {
  placeholder.value = true
  try {
    const token = localStorage.getItem('auth_token')
    const response = await axios.get(`${API_URL}/mahasiswa/total`, {
      headers: { Authorization: `Bearer ${token}` },
    })
    console.log(response.data.data)
    countMahasiswa.value = response.data.data
  } catch (error) {
    console.error('Error fetching mahasiswa:', error)
  } finally {
    placeholder.value = false
  }
}

onMounted(() => fetchMahasiswa())
</script>

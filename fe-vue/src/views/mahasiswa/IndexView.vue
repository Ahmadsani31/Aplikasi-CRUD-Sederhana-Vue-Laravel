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
          <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Data Mahasiswa</h4>
            <RouterLink to="/mahasiswa/create" class="btn btn-primary">Tambah Data</RouterLink>
          </div>
          <div class="mx-4 mt-2">
            <div class="input-group mb-3">
              <input
                type="search"
                v-model="searchQuery"
                class="form-control"
                placeholder="Cari Data..."
              />
              <button class="btn btn-info input-group-text" @click="fetchMahasiswa(1)">
                Filter
              </button>
            </div>
          </div>

          <div class="card-body table-border-style">
            <div class="table-responsive">
              <table class="table text-center">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>No HP</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <template v-if="placeholder">
                    <tr v-for="(m, index) in mahasiswa" :key="m.id">
                      <td>{{ (pagination.current_page - 1) * perPage + index + 1 }}</td>
                      <td>{{ m.nim }}</td>
                      <td>{{ m.nama }}</td>
                      <td>{{ m.email }}</td>
                      <td>{{ m.no_handphone }}</td>
                      <td>{{ m.alamat }}</td>
                      <td>
                        <RouterLink
                          :to="{ name: 'mahasiswa-edit', params: { id: m.id } }"
                          class="btn btn-warning btn-sm m-1"
                          ><i class="fas fa-edit"></i
                        ></RouterLink>
                        <button @click="deleteMahasiswa(m.id)" class="btn btn-danger btn-sm m-1">
                          <i class="fas fa-trash"></i>
                        </button>
                      </td>
                    </tr>
                  </template>
                  <template v-else>
                    <td colspan="7">
                      <div class="ph-item">
                        <div class="ph-col-12">
                          <div class="ph-row">
                            <div class="ph-col-12"></div>
                            <div class="ph-col-12"></div>
                            <div class="ph-col-12"></div>
                            <div class="ph-col-12"></div>
                            <div class="ph-col-12"></div>
                            <div class="ph-col-12"></div>
                            <div class="ph-col-12"></div>
                          </div>
                        </div>
                      </div>
                    </td>
                  </template>
                </tbody>
              </table>
              <div class="d-flex justify-content-between align-items-center">
                <p>
                  Showing {{ pagination.from }} to {{ pagination.to }} of
                  {{ pagination.total }} entries
                </p>
                <Bootstrap5Pagination
                  :data="dataMahasiswa"
                  @pagination-change-page="fetchMahasiswa"
                />
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- [ sample-page ] end -->
    </div>
    <!-- [ Main Content ] end -->
  </div>
</template>
<script setup lang="ts">
import { Bootstrap5Pagination } from 'laravel-vue-pagination'
import { ref, onMounted } from 'vue'
import API_URL from '@/config'

import { RouterLink } from 'vue-router'

import axios from 'axios'

const dataMahasiswa = ref(Array<string>)
const perPage = ref(10)
const placeholder = ref(false)

interface Mahasiswa {
  id: number
  nim: string
  nama: string
  email: string
  no_handphone: string
  alamat: string
}

interface Pagination {
  current_page: number
  from: number
  to: number | null
  total: number | null
}

const pagination = ref<Pagination>({
  current_page: 1,
  from: 1,
  to: null,
  total: null,
})

const mahasiswa = ref<Mahasiswa[]>([])

const searchQuery = ref('')

const fetchMahasiswa = async (page = 1) => {
  placeholder.value = false
  try {
    const token = localStorage.getItem('auth_token')
    const response = await axios.get(`${API_URL}/mahasiswa`, {
      headers: { Authorization: `Bearer ${token}` },
      params: { page, search: searchQuery.value },
    })
    console.log(response.data.data)
    dataMahasiswa.value = response.data.data
    mahasiswa.value = response.data.data.data
    pagination.value = {
      current_page: response.data.data.current_page,
      from: response.data.data.from,
      to: response.data.data.to,
      total: response.data.data.total,
    }
    placeholder.value = true
  } catch (error) {
    console.error('Error fetching mahasiswa:', error)
  } finally {
    placeholder.value = true
  }
}

const deleteMahasiswa = async (id: number) => {
  placeholder.value = false
  if (!confirm('Apakah Anda yakin ingin menghapus data ini?')) return
  try {
    const token = localStorage.getItem('auth_token')
    await axios.delete(`${API_URL}/mahasiswa/delete/${id}`, {
      headers: { Authorization: `Bearer ${token}` },
    })
    fetchMahasiswa(pagination.value.current_page)
  } catch (error) {
    console.error('Error deleting mahasiswa:', error)
  } finally {
    placeholder.value = true
  }
}

onMounted(() => fetchMahasiswa())

console.log(mahasiswa.value.length)
</script>

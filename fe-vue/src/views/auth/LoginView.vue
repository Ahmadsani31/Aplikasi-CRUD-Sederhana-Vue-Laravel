<script setup lang="ts">
import { useTemplateRef, onMounted } from 'vue'
import { RouterLink } from 'vue-router'
import { ref } from 'vue'
import { useAuthStore } from '@/stores/auth'
import { useRouter } from 'vue-router'

const email = ref('')
const password = ref('')
const isLoading = ref(false)
const errorMessage = ref('')
const authStore = useAuthStore()
const router = useRouter()

const handleLogin = async () => {
  isLoading.value = true
  errorMessage.value = '' // Reset error sebelum login
  try {
    const response = await authStore.login(email.value, password.value)
    // console.log(response)
    if (response.status === false) {
      errorMessage.value = response.data.error
    } else {
      router.push('/dashboard')
    }
  } catch (error) {
    // alert(error)
    errorMessage.value = (error as Error).message
  } finally {
    isLoading.value = false
  }
}

const input = useTemplateRef('email_focus')

onMounted(() => {
  input.value?.focus()
})
</script>
<template>
  <div class="auth-main">
    <div class="auth-wrapper v3">
      <div class="auth-form">
        <div class="auth-header"></div>
        <div class="card my-5">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-end mb-4">
              <h3 class="mb-0"><b>Login</b></h3>
              <RouterLink to="/register" class="link-primary">Don't have an account?</RouterLink>
              <!-- <a href="#" class="link-primary">Don't have an account?</a> -->
            </div>
            <div class="alert alert-danger" v-if="errorMessage" role="alert">
              {{ errorMessage }}
            </div>
            <form @submit.prevent="handleLogin" class="mt-4">
              <div class="form-group mb-3">
                <label class="form-label">Email Address</label>
                <input
                  type="email"
                  ref="email_focus"
                  v-model="email"
                  class="form-control"
                  placeholder="Email Address"
                  autocomplete="username"
                />
              </div>
              <div class="form-group mb-3">
                <label class="form-label">Password</label>
                <input
                  type="password"
                  class="form-control"
                  v-model="password"
                  placeholder="Password"
                  autocomplete="current-password"
                />
              </div>
              <div class="d-grid mt-4">
                <button type="submit" class="btn btn-primary">
                  <span v-if="isLoading">
                    <div class="spinner-border spinner-border-sm" role="status">
                      <span class="visually-hidden">Loading...</span>
                    </div>
                    Login
                  </span>
                  <span v-else>Login</span>
                </button>
              </div>
            </form>
          </div>
        </div>
        <div class="auth-footer row"></div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { RouterLink, useRouter } from 'vue-router'
import { onMounted, ref, useTemplateRef } from 'vue'
import { useAuthStore } from '@/stores/auth'

const name = ref('')
const email = ref('')
const password = ref('')
const password_confirmation = ref('')
const errorMessage = ref('')
const isLoading = ref(false)
const authStore = useAuthStore()
const router = useRouter()

// Menyimpan error dalam array untuk setiap field
const errors = ref<{
  name: string[]
  email: string[]
  password: string[]
  password_confirmation: string[]
}>({
  email: [],
  name: [],
  password: [],
  password_confirmation: [],
})

const handleRegister = async () => {
  isLoading.value = true
  errorMessage.value = '' // Reset error sebelum register
  try {
    const response = await authStore.register(
      name.value,
      email.value,
      password.value,
      password_confirmation.value,
    )

    if (response.status === false) {
      Object.keys(response.data.error).forEach((key) => {
        console.log(key)
        if (key in errors.value) {
          errors.value[key as keyof typeof errors.value] = response.data.error[key]
        }
      })
    } else {
      router.push('/login')
    }
  } catch (error) {
    console.log(error)
  } finally {
    isLoading.value = false
  }
}

// Fungsi validasi input berdasarkan field
const validateFields = (field: 'name' | 'email' | 'password' | 'password_confirmation') => {
  errors.value[field] = [] // Reset error sebelum validasi

  if (field === 'email') {
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/
    if (!email.value) {
      errors.value.email.push('Email wajib diisi.')
    } else if (!emailPattern.test(email.value)) {
      errors.value.email.push('Format email tidak valid.')
    }
  }

  if (field === 'password_confirmation') {
    if (password.value !== password_confirmation.value) {
      errors.value.password_confirmation.push('Password dan password confirmation tidak sama')
    } else {
      errors.value.password_confirmation = []
    }
  }
}
const input = useTemplateRef('name_focus')

onMounted(() => {
  input.value?.focus()
})
// console.log(errors.value)
</script>
<template>
  <div class="auth-main">
    <div class="auth-wrapper v3">
      <div class="auth-form">
        <div class="auth-header"></div>
        <div class="card my-5">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-end mb-4">
              <h3 class="mb-0"><b>Sign up</b></h3>
              <RouterLink to="/" class="link-primary">Already have an account?</RouterLink>
            </div>
            <div class="alert alert-danger" v-if="errorMessage.length" role="alert">
              <template v-for="error in errorMessage" :key="error[0]">
                {{ error }}
              </template>
            </div>

            <form @submit.prevent="handleRegister" method="post">
              <div class="form-group mb-3">
                <label class="form-label">Nama</label>
                <input
                  type="text"
                  class="form-control"
                  :class="{ 'is-invalid': errors.name.length > 0 }"
                  v-model="name"
                  ref="name_focus"
                  placeholder="Name"
                  @blur="validateFields('name')"
                  required
                />
                <div class="invalid-feedback">
                  {{ errors.email[0] }}
                </div>
              </div>
              <div class="form-group mb-3">
                <label class="form-label">Email</label>
                <input
                  type="text"
                  class="form-control"
                  :class="{ 'is-invalid': errors.email.length > 0 }"
                  v-model="email"
                  placeholder="Email"
                  @blur="validateFields('email')"
                  required
                />
                <div class="invalid-feedback">
                  {{ errors.email[0] }}
                </div>
              </div>
              <div class="form-group mb-3">
                <label class="form-label">Password</label>
                <input
                  type="password"
                  class="form-control"
                  v-model="password"
                  placeholder="Password"
                  @blur="validateFields('password')"
                  required
                />
                <div class="invalid-feedback">
                  {{ errors.password[0] }}
                </div>
              </div>
              <div class="form-group mb-3">
                <label class="form-label">Password Confirmation</label>
                <input
                  type="password"
                  class="form-control"
                  :class="{ 'is-invalid': errors.password_confirmation.length > 0 }"
                  v-model="password_confirmation"
                  @blur="validateFields('password_confirmation')"
                  placeholder="Password Confirmation"
                  required
                />
                <div id="cityFeedback" class="invalid-feedback">
                  {{ errors.password_confirmation[0] }}
                </div>
              </div>
              <p class="mt-4 text-sm text-muted">
                By Signing up, you agree to our
                <a href="#" class="text-primary"> Terms of Service </a> and
                <a href="#" class="text-primary"> Privacy Policy</a>
              </p>
              <div class="d-grid mt-3">
                <button type="submit" class="btn btn-primary">
                  <template v-if="isLoading">
                    <div class="spinner-border spinner-border-sm" role="status">
                      <span class="visually-hidden">Loading...</span>
                    </div>
                    Create Account</template
                  >
                  <template v-else>Create Account</template>
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

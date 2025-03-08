import { defineStore } from 'pinia'
import axios from 'axios'
import router from '@/router'
import API_URL from '@/config'

interface UserToken {
  id: number
  name: string
  email: string
}

export const useAuthStore = defineStore('auth', {
  state: () => ({
    user: null as UserToken | null, // Hanya menyimpan token, bukan seluruh user
    isLoading: false,
  }),
  getters: {
    isAuthenticated: (state): boolean => !!state.user, // True jika token ada
  },
  actions: {
    async login(email: string, password: string) {
      try {
        const response = await axios.post(`${API_URL}/login`, {
          email,
          password,
        })
        console.log(response.data.data.token)

        if (response.data.status === true) {
          // this.user = { token: response.data.data.token }

          localStorage.setItem('auth_token', response.data.data.token)
          return response.data // Login berhasil
        } else {
          throw new Error('Token tidak ditemukan dalam response')
        }
      } catch (error: unknown) {
        if (axios.isAxiosError(error)) {
          return error.response?.data
        } else {
          console.error('Unexpected error:', error)
        }
      }
    },

    async register(name: string, email: string, password: string, password_confirmation: string) {
      try {
        const response = await axios.post(`${API_URL}/register`, {
          name,
          email,
          password,
          password_confirmation,
        })

        return response.status // Register berhasil jika status 201
      } catch (error: unknown) {
        if (axios.isAxiosError(error)) {
          return error.response?.data
        } else {
          console.error('Unexpected error:', error)
        }
      }
    },

    async checkToken(): Promise<boolean> {
      this.isLoading = true
      const token = localStorage.getItem('auth_token')
      // console.log(token)

      if (!token) {
        this.isLoading = false
        return false
      }

      try {
        const response = await axios.get(`${API_URL}/user`, {
          headers: { Authorization: `Bearer ${token}` },
        })
        // console.log(response.data.data)

        if (response.data.status === true) {
          this.user = {
            id: response.data.data.id,
            name: response.data.data.name,
            email: response.data.data.email,
          }
          return true
        } else {
          return false
        }
      } catch (error) {
        console.error('Unexpected error:', error)
        // this.logout()
        this.user = null
        localStorage.removeItem('auth_token')
        return false
      } finally {
        this.isLoading = false
      }
    },

    async logout() {
      this.isLoading = true
      try {
        const token = localStorage.getItem('auth_token')
        await axios.post(
          `${API_URL}/logout`,
          {},
          {
            headers: { Authorization: `Bearer ${token}` },
          },
        )
        this.user = null
        localStorage.removeItem('auth_token')
        router.push('/')
      } catch (error) {
        console.error('Unexpected error:', error)
      } finally {
        this.isLoading = false
      }
    },
  },
})

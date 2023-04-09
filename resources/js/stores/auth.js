import { defineStore } from 'pinia'
import { useToast } from 'vue-toastification'
import http from '@/http'
import router from '@/router'

const toast = useToast()

export const useAuthStore = defineStore({
  id: 'auth',

  state: () => ({
    user: JSON.parse(localStorage.getItem('user')),
  }),

  getters: {
    check: state => !!state.user
  },

  actions: {
    login (data) {
      http.get('/sanctum/csrf-cookie').then(() => {
        http.post('/auth/login', data)
          .then((response) => {
            this.setUser(response.data)
            router.push({ name: 'home' })
          })
          .catch((error) => {
            //
          })
      })
    },

    register (data) {
      http.get('/sanctum/csrf-cookie').then(() => {
        http.post('/auth/register', data)
          .then((response) => {
            this.setUser(response.data)
            toast.success('Welcome!')
            router.push({ name: 'home' })
          })
          .catch((error) => {
            //
          })
      })
    },

    forgot (data) {
      http.get('/sanctum/csrf-cookie').then(() => {
        http.post('/auth/forgot-password', data)
          .then((response) => {
            toast.info(response.data.message)
            router.push({ name: 'auth.login' })
          })
          .catch((error) => {
            //
          })
      })
    },

    resetPassword (data) {
      http.get('/sanctum/csrf-cookie').then(() => {
        http.post('/auth/reset-password', data)
          .then((response) => {
            toast.success(response.data.message)
            router.push({ name: 'auth.login' })
          })
          .catch((error) => {
            //
          })
      })
    },

    logout () {
      http.post('/auth/logout').finally(() => this.kill())
    },

    setUser (user) {
      this.user = user

      localStorage.setItem('user', JSON.stringify(user))
    },

    kill () {
      this.setUser(null)

      router.push({ name: 'auth.login' })
    }
  }
})

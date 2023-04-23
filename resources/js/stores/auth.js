import { defineStore } from 'pinia'
import { useToast } from 'vue-toastification'
import http from '@/http'
import router from '@/router'

const toast = useToast()

export const useAuthStore = defineStore({
  id: 'auth',

  state: () => ({
    user: JSON.parse(localStorage.getItem('user')),
    redirectTo: null,
  }),

  getters: {
    check: state => !!state.user,
  },

  actions: {
    refreshUser () {
      if (!this.check) {
        return
      }

      http.get('/api/auth/user')
        .then((response) => {
          this.setUser(response.data.data)
        })
        .catch((error) => {
          //
        })
    },

    loginUser(data, redirectTo = null) {
      this.setUser(data)

      if (this.redirectTo || redirectTo) {
        router.push(this.redirectTo || redirectTo)

        this.redirectTo = null
      }
    },

    login (data) {
      http.get('/sanctum/csrf-cookie').then(() => {
        http.post('/auth/login', data)
          .then((response) => {
            this.loginUser(response.data, { name: 'home' })
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
            this.loginUser(response.data, { name: 'home' })

            toast.success('Welcome! Check your email and verify your account')
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

    can () {
      if (!this.check) {
        this.redirectTo = {
          name: router.currentRoute.value.name,
          params: router.currentRoute.value.params,
        }

        router.push({ name: 'auth.login' })
      }

      return this.check
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

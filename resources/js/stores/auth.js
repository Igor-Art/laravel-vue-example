import { defineStore } from 'pinia'
import http from '@/http'
import router from '@/router'

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

            router.push('/')
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
            console.log(response)
            this.setUser(response.data)

            router.push('/')
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
            //

            router.push('/login')
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
            //

            router.push('/login')
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

      router.push('/login')
    }
  }
})

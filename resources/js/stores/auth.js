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
    id: state => state.user?.id,
    isTwoFactor: state => state.user?.two_factor_enabled,
  },

  actions: {
    refreshUser () {
      if (!this.check) {
        return
      }

      http.get('/api/auth/user')
        .then((response) => {
          const user = response.data

          if (!this.validateUser(user)) {
            return this.logout()
          }

          this.setUser(user)
        })
        .catch((error) => {
          //
        })
    },

    loginUser(data, redirectTo = null) {
      if (!this.validateUser(data)) {
        return this.logout()
      }

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
            if (response.data.two_factor) {
              router.push('/two-factor')
            } else {
              this.loginUser(response.data, { name: 'home' })
            }
          })
          .catch((error) => {
            //
          })
      })
    },

    loginTwoFactor (data) {
      http.get('/sanctum/csrf-cookie').then(() => {
        http.post('/auth/two-factor-challenge', data)
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
      http.post('/auth/logout').finally(() => this.kill(false))
    },

    can () {
      if (!this.check) {
        this.setRedirectToCurrent()

        router.push({ name: 'auth.login' })
      }

      return this.check
    },

    validateUser (user) {
      return user && 'id' in user
    },

    setUser (user) {
      if (!this.validateUser(user)) {
        user = null
      }

      this.user = user

      localStorage.setItem('user', JSON.stringify(user))
    },

    kill (preserveRedirect = true) {
      this.setUser(null)

      if (preserveRedirect) {
        this.setRedirectToCurrent()
      }

      router.push({ name: 'auth.login' })
    },

    setRedirectTo (name, params) {
      this.redirectTo = { name, params }
    },

    setRedirectToCurrent () {
      this.setRedirectTo(router.currentRoute.value.name, router.currentRoute.value.params)
    },
  }
})

import axios from 'axios'
import { useToast } from 'vue-toastification'
import router from '@/router'
import { useAuthStore } from '@/stores/auth'

const toast = useToast()

const http = axios.create({
  baseURL: import.meta.env.VITE_API_URL,
  withCredentials: true,
})

http.interceptors.response.use(
  response => response,
  (error) => {
    const authStore = useAuthStore()

    if ([401, 403, 419].includes(error.response.status) && authStore.check) {
      useAuthStore().kill()

      return
    }

    if (404 === error.response.status) {
      router.push('/404')

      return
    }

    const message = error.response.data.errors
      ? Object.values(error.response.data.errors).join('<br>')
      : (error.response.data.message || error.message)

    toast.error(message || 'An error has occurred')

    return Promise.reject(error)
  },
)

export default http

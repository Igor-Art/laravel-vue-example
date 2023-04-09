import axios from 'axios'
import router from '@/router'
import { useAuthStore } from '@/stores/auth'

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

    return Promise.reject(error)
  },
)

export default http

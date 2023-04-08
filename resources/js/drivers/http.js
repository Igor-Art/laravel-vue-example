import axios from 'axios'
import router from '@/router'

const http = axios.create({
  baseURL: import.meta.env.VITE_API_URL,
  withCredentials: true,
})

http.interceptors.response.use(
  response => response,
  (error) => {
    if (404 === error.response.status) {
      router.push('/404')

      return
    }

    return Promise.reject(error)
  },
)

export default http

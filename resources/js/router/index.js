import { createRouter, createWebHistory } from 'vue-router'
import { useToast } from 'vue-toastification'
import { useAuthStore } from '@/stores/auth'
import routes from './routes'

const router = createRouter({
  routes,
  history: createWebHistory(),
  scrollBehavior (to, from, savedPosition) {
    return new Promise((resolve, reject) => {
      setTimeout(() => {
        resolve(savedPosition ? savedPosition : { top: 0 })
      }, 100)
    })
  },
})

router.beforeEach((to, from) => {
  const auth = useAuthStore()

  if (to.meta.auth === true && !auth.check) {
    return { name: 'auth.login' }
  }

  if (to.meta.auth === false && auth.check) {
    return { name: 'home' }
  }
})

router.beforeResolve(async to => {
  if (to.query.verified) {
    useToast().success('You have successfully verified your email')
    router.replace({ query: null })
  }
})

export default router

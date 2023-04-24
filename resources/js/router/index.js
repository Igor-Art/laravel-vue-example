import { createRouter, createWebHistory } from 'vue-router'
import { useToast } from 'vue-toastification'
import { useAuthStore } from '@/stores/auth'
import { useGameFilterStore } from '@/stores/game-filter'
import routes from './routes'

const router = createRouter({
  routes,
  history: createWebHistory(),
  scrollBehavior (to, from, savedPosition) {
    if (from && to.fullPath.split('?')[0] === from.fullPath.split('?')[0]) {
      return
    }

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
    auth.setRedirectTo(to.name, to.params)

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

  } else if (to.name === 'games.index' && Object.keys(to.query).length) {
    const filterStore = useGameFilterStore()
    filterStore.initFilter(to.query)
  }
})

export default router

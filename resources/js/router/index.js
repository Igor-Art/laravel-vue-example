import { createRouter, createWebHistory } from 'vue-router'
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
  //
})

export default router

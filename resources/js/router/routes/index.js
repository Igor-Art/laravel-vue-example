import HomeView from '@/views/Home.vue'
import authRoutes from './auth'
import gamesRoutes from './games'

export default [
  {
    path: '/',
    name: 'home',
    component: HomeView,
    meta: {
      auth: null,
    },
  },
  ...authRoutes,
  ...gamesRoutes,
  {
    path: '/:pathMatch(.*)',
    name: 'not-found',
    component: () => import('@/views/404.vue'),
  },
]

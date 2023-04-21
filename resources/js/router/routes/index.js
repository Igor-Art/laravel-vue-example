import HomeView from '@/views/Home.vue'
import authRoutes from './auth'
import gamesRoutes from './games'
import profileRoutes from './profile'

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
  ...profileRoutes,
  {
    path: '/:pathMatch(.*)',
    name: 'not-found',
    component: () => import('@/views/Errors/404.vue'),
  },
]

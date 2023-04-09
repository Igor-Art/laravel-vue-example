import HomeView from '@/views/Home.vue'
import authRoutes from './auth'

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
  {
    path: '/:pathMatch(.*)',
    name: 'not-found',
    component: () => import('@/views/404.vue'),
  },
]

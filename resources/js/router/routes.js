import HomeView from '@/views/Home.vue'

export default [
  {
    path: '/',
    name: 'home',
    component: HomeView,
  },
  {
    path: '/:pathMatch(.*)',
    name: 'not-found',
    component: () => import('@/views/404.vue'),
  },
]

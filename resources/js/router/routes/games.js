export default [
  {
    path: '/games',
    name: 'games.index',
    component: () => import('@/views/Games/List.vue'),
    meta: {
      auth: null,
    },
  },
  {
    path: '/games/:slug',
    name: 'games.show',
    component: () => import('@/views/Games/Show.vue'),
    meta: {
      auth: null,
    },
  },
]

export default [
  {
    path: '/games',
    name: 'games.index',
    component: () => import('@/views/Games/GameList.vue'),
    meta: {
      auth: null,
    },
  },
  {
    path: '/games/:slug',
    name: 'games.show',
    component: () => import('@/views/Games/GameShow.vue'),
    meta: {
      auth: null,
    },
  },
]

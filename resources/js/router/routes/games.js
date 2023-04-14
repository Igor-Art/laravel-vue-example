export default [
  {
    path: '/games/:slug',
    name: 'games.show',
    component: () => import('@/views/Games/Show.vue'),
    meta: {
      auth: null,
    },
  },
]

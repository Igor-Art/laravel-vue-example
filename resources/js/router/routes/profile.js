export default [
  {
    path: '/profile/:name',
    name: 'profile.show',
    component: () => import('@/views/Profile/ProfileShow.vue'),
    meta: {
      auth: null,
    },
  },
]

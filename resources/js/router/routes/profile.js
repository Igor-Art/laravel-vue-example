export default [
  {
    path: '/profile/:id',
    name: 'profile.show',
    component: () => import('@/views/Profile/ProfileShow.vue'),
    meta: {
      auth: null,
    },
  },
]

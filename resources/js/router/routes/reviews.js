export default [
  {
    path: '/reviews',
    name: 'reviews.index',
    component: () => import('@/views/Reviews/ReviewList.vue'),
    meta: {
      auth: null,
    },
  },
]

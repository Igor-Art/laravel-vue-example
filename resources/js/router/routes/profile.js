export default [
  {
    path: '/profile/:id',
    name: 'profile.show',
    component: () => import('@/views/Profile/ProfileShow.vue'),
    meta: {
      auth: null,
    },
    children: [
      {
        path: 'reviews',
        name: 'profile.show.reviews',
        component: () => import('@/views/Profile/Sections/ProfileReviews.vue'),
        meta: {
          auth: null,
        },
      },
      {
        path: 'wishlist',
        name: 'profile.show.wishlist',
        component: () => import('@/views/Profile/Sections/ProfileWishlist.vue'),
        meta: {
          auth: null,
        },
      }
    ],
  },
]

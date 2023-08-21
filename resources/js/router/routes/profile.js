export default [
  {
    path: '/profile/settings',
    name: 'profile.settings',
    component: () => import('@/views/Profile/ProfileSettings.vue'),
    meta: {
      auth: true,
    },
  },
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
        component: () => import('@/views/Profile/Sections/Show/ProfileReviews.vue'),
        meta: {
          auth: null,
        },
      },
      {
        path: 'wishlist',
        name: 'profile.show.wishlist',
        component: () => import('@/views/Profile/Sections/Show/ProfileWishlist.vue'),
        meta: {
          auth: null,
        },
      }
    ],
  },
]

export default [
  {
    path: '/login',
    name: 'auth.login',
    component: () => import('@/views/Auth/Login.vue'),
    meta: {
      auth: false,
    },
  },
  {
    path: '/two-factor',
    name: 'auth.two-factor',
    component: () => import('@/views/Auth/TwoFactor.vue'),
    meta: {
      auth: false,
    },
  },
  {
    path: '/register',
    name: 'auth.register',
    component: () => import('@/views/Auth/Register.vue'),
    meta: {
      auth: false,
    },
  },
  {
    path: '/forgot',
    name: 'auth.forgot',
    component: () => import('@/views/Auth/Forgot.vue'),
    meta: {
      auth: false,
    },
  },
  {
    path: '/reset-password/:token',
    name: 'auth.reset-password',
    component: () => import('@/views/Auth/ResetPassword.vue'),
    meta: {
      auth: false,
    },
  },
]

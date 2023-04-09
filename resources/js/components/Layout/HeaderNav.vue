<script setup>
import { RouterLink } from 'vue-router'
import { useAuthStore } from '@/stores/auth'

const auth = useAuthStore()
</script>

<template>
  <nav class="container flex justify-between">
    <div class="flex items-center">
      <RouterLink :to="{ name: 'home' }" class="item">Home</RouterLink>
    </div>
    <div class="flex items-center">
      <RouterLink v-if="!auth.check" :to="{ name: 'auth.login' }" class="item">Login</RouterLink>
      <RouterLink v-if="!auth.check" :to="{ name: 'auth.register' }" class="item">Register</RouterLink>
      <span v-if="auth.check" class="item">
          <span class="mr-2 text-xs">👤</span>
          <span>{{ auth.user.name }}</span>
        </span>
      <button v-if="auth.check" @click="auth.logout()" class="item">Logout</button>
    </div>
  </nav>
</template>

<style scoped lang="scss">
.item {
  @apply block relative py-3;

  &:not(:last-child) {
    @apply mr-4;
  }

  &:before {
    @apply block absolute bg-sky-500;
    content: '';
    left: 51%;
    right: 51%;
    bottom: -1px;
    height: 1px;
    border-radius: 1px;
    transition-property: left, right;
    transition-duration: 300ms;
    transition-timing-function: ease-out;
    transition-delay: 180ms;
  }
  &.router-link-active,
  &:hover {
    &:before {
      left: -5px;
      right: -5px;
    }
  }
}
</style>

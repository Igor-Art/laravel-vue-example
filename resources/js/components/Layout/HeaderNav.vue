<script setup>
import { RouterLink } from 'vue-router'
import { useAuthStore } from '@/stores/auth'
import { useSettingsStore } from '@/stores/settings'

const auth = useAuthStore()
const settings = useSettingsStore()
</script>

<template>
  <nav class="container flex justify-between">
    <div class="flex items-center">
      <RouterLink :to="{ name: 'home' }" class="item">
        Home
      </RouterLink>
      <RouterLink :to="{ name: 'games.index' }" class="item">
        Games
      </RouterLink>
      <RouterLink :to="{ name: 'reviews.index' }" class="item">
        Reviews
      </RouterLink>
    </div>
    <div class="flex items-center">
      <a
        v-if="settings.github"
        :href="settings.github"
        class="item mr-10 leading-none"
        target="_blank"
        rel="nofollow noopener noreferrer"
        aria-label="GitHub"
        title="Go to GitHub"
      >
        <font-awesome-icon :icon="['brands', 'github']" class="mr-1 text-xl" />
      </a>
      <RouterLink
        v-if="!auth.check"
        :to="{ name: 'auth.login' }"
        class="item"
      >
        Login
      </RouterLink>
      <RouterLink
        v-if="!auth.check"
        :to="{ name: 'auth.register' }"
        class="item"
      >
        Register
      </RouterLink>
      <span v-if="auth.check" class="item">
        <font-awesome-icon icon="user" class="mr-2 text-xs" />
        <span>{{ auth.user.name }}</span>
      </span>
      <button v-if="auth.check" @click="auth.logout()" class="item">
        <font-awesome-icon icon="right-from-bracket" aria-label="Logout" />
      </button>
    </div>
  </nav>
</template>

<style scoped lang="scss">
@layer component {
  .item {
    @apply block relative py-3;

    &:not(:last-child) {
      @apply mr-6;
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
}
</style>

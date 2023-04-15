<script setup>
import { RouterView } from 'vue-router'
import HeaderNav from '@/components/Layout/HeaderNav.vue'
</script>

<template>
  <header class="bg-black bg-opacity-20 border-b border-black border-opacity-20">
    <HeaderNav />
  </header>
  <main class="container pt-8 pb-2">
    <RouterView v-slot="{ Component, route }">
      <Transition name="fade" mode="out-in" appear>
        <Component :is="Component" :key="route.path" />
      </Transition>
    </RouterView>
  </main>
</template>

<style scoped>
.fade-enter-active,
.fade-leave-active {
  transition: opacity .4s ease;
}
.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}
</style>

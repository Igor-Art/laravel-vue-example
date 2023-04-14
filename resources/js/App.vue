<script setup>
import { RouterView } from 'vue-router'
import HeaderNav from '@/components/Layout/HeaderNav.vue'
</script>

<template>
  <header class="bg-black bg-opacity-20 border-b border-black border-opacity-20">
    <HeaderNav />
  </header>
  <main class="container pt-8 pb-2">
    <RouterView />
  </main>
</template>

<script setup>
import { RouterLink, RouterView } from 'vue-router'
</script>

<template>
  <header>
    <div class="container">
      <RouterLink to="/">Home</RouterLink>
    </div>
  </header>
  <main class="container">
    <RouterView />
  </main>
</template>

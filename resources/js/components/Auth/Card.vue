<script setup>
</script>

<template>
  <div class="w-96 pt-10 pb-6 px-6 border border-white border-opacity-20 rounded-lg shadow-xl bg-card">
    <slot />
  </div>
</template>

<style scoped>
.bg-card {
  background: transparent linear-gradient(to right bottom, rgba(255,255,255, 0) 60%, rgba(255,255,255, .08));
}
</style>

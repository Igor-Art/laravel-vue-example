<script setup>
defineProps({
  game: {
    type: Object,
    required: true,
  },
})
</script>

<template>
  <div class="w-48 mb-4 mr-4">
    <img :src="game.cover_url" :alt="game.title" />
    <div>{{ game.title }} ({{ game.rating || 0 }})</div>
  </div>
</template>

<script setup>
defineProps({
  review: {
    type: Object,
    required: true,
  }
})
</script>

<template>
  <div>
    <div class="flex items-center mb-2">
      <div class="mr-4">
        <font-awesome-icon icon="user" class="w-2.5 mr-1" />
        {{ review.user.name }}
      </div>
      <div class="mr-4 text-base" :aria-label="`Rating ${review.rating}`" :title="`${review.rating}`">
        <font-awesome-icon icon="star" v-for="index in parseInt(review.rating)" :key="index" class="w-2.5" />
      </div>
      <RouterLink :to="{ name: 'games.show', params: { slug: review.game.slug } }" class="underline">
        {{ review.game.title }}
      </RouterLink>
    </div>
    <div v-html="review.content" class="max-w-xl font-light"></div>
  </div>
</template>

<style scoped lang="scss"></style>

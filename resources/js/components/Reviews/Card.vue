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
    <div class="flex items-center mb-1">
      <div class="mr-4">
        <font-awesome-icon icon="user" class="w-2.5 mr-1" />
        <RouterLink to="/">
          {{ review.user.name }}
        </RouterLink>
      </div>
      <div class="mr-4 text-base" :aria-label="`Rating ${review.rating}/5`" :title="`${review.rating}/5`">
        <font-awesome-icon icon="star" v-for="index in parseInt(review.rating)" :key="index" class="w-2.5" />
      </div>
      <RouterLink :to="{ name: 'games.show', params: { slug: review.game.slug } }" class="underline">
        {{ review.game.title }}
      </RouterLink>
    </div>
    <div v-html="review.content" class="font-light"></div>
  </div>
</template>

<style scoped lang="scss"></style>

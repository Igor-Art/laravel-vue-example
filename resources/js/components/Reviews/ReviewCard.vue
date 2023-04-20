<script setup>
import RatingBar from '@/components/RatingBar.vue'

defineProps({
  review: {
    type: Object,
    required: true,
  },
})
</script>

<template>
  <div>
    <div class="flex items-center mb-1">
      <div class="mr-4">
        <font-awesome-icon icon="user" class="w-2.5 mr-2" />
        <RouterLink to="/">
          {{ review.user.name }}
        </RouterLink>
      </div>
      <RatingBar :rating="review.rating" icon-class="w-2.5" class="mr-4 text-base" />
      <RouterLink v-if="review.game" :to="{ name: 'games.show', params: { slug: review.game.slug } }" class="underline">
        {{ review.game.title }}
      </RouterLink>
    </div>
    <div v-html="review.content" class="font-light"></div>
  </div>
</template>

<style scoped lang="scss"></style>

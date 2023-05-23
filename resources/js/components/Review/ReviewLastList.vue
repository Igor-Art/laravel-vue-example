<script setup>
import { reactive } from 'vue'
import http from '@/http'
import ReviewCard from '@/components/Review/ReviewCard.vue'
import MoreLink from '@/components/MoreLink.vue'

const reviews = reactive({
  items: [],
})

const fetchReviews = async () => {
  const response = await http.get('/api/reviews/last')

  reviews.items = response.data.data
}

await fetchReviews()
</script>

<template>
  <div class="max-w-xl pl-2">
    <div class="logline-mask overflow-y-hidden max-h-64 mb-2">
      <ReviewCard
        v-for="item in reviews.items"
        :key="item.id"
        :review="item"
        class="mb-6"
      />
    </div>
    <div class="text-right pr-2">
      <MoreLink :to="{ name: 'reviews.index' }" label="Show all" />
    </div>
  </div>
</template>

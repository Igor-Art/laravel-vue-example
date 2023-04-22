<script setup>
import { reactive } from 'vue'
import http from '@/http'
import ReviewCard from '@/components/Reviews/ReviewCard.vue'
import Headline from '@/components/Headline.vue'

const reviews = reactive({
  meta: {},
  items: [],
})

const fetchReviews = async () => {
  const response = await http.get('/api/reviews')

  reviews.meta = response.data.meta
  reviews.items = response.data.data
}

await fetchReviews()
</script>

<template>
  <div>
    <Headline icon="comments" class="!mb-10">Reviews</Headline>
    <div class="max-w-lg">
      <ReviewCard
        v-for="review in reviews.items"
        :key="review.id"
        :review="review"
        class="mb-6"
      />
    </div>
  </div>
</template>

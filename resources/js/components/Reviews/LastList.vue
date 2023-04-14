<script setup>
import { reactive } from 'vue'
import http from '@/http'
import ReviewCard from '@/components/Reviews/Card.vue'

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
  <div>
    <ReviewCard
      v-for="item in reviews.items"
      :key="item.id"
      :review="item"
      class="mb-4"
    />
  </div>
</template>

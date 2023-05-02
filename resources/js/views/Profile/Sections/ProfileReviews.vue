<script setup>
import PaginatedList from '@/components/Lists/PaginatedList.vue'
import ReviewCard from '@/components/Review/ReviewCard.vue'
import { reactive } from 'vue'
import http from '@/http'
import { useRoute } from 'vue-router'

const route = useRoute()

const reviews = reactive({
  meta: {},
  items: [],
})

const fetchReviews = async (params = {}) => {
  const response = await http.get(`/api/users/${route.params.id}/reviews`, { params })

  reviews.meta = response.data.meta
  reviews.items = params.cursor
    ? reviews.items.concat(response.data.data)
    : response.data.data
}

await fetchReviews()
</script>

<template>
  <div>
    <PaginatedList
      v-if="reviews.items.length"
      :component="ReviewCard"
      :items="reviews.items"
      :meta="reviews.meta"
      item-prop-name="review"
      scope-route="profile.show.reviews"
      class="max-w-lg"
      class-pagination="mt-10"
      class-item="mb-6"
      @changed="params => fetchReviews(params)"
    />
    <div v-else>
      Reviews is empty
    </div>
  </div>
</template>

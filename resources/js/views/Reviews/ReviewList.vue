<script setup>
import { reactive } from 'vue'
import { useRoute } from 'vue-router'
import http from '@/http'
import { useMeta } from '@/plugins/meta'
import ReviewCard from '@/components/Review/ReviewCard.vue'
import Headline from '@/components/Headline.vue'
import EmptyList from '@/components/Lists/EmptyList.vue'
import PaginatedList from '@/components/Lists/PaginatedList.vue'

const route = useRoute()

const reviews = reactive({
  meta: {},
  items: [],
})

const fetchReviews = async (params = {}) => {
  const response = await http.get('/api/reviews', { params })

  reviews.meta = response.data.meta
  reviews.items = response.data.data
}

useMeta().setTitle('Reviews')

await fetchReviews({
  page: route.query.page || 1
})
</script>

<template>
  <div>
    <Headline icon="comments" class="!mb-10">Reviews</Headline>
    <div class="mb-4">
      Total: {{ reviews.meta.total }}
    </div>
    <div v-if="reviews.items.length">
      <PaginatedList
        :component="ReviewCard"
        :items="reviews.items"
        :meta="reviews.meta"
        item-prop-name="review"
        scope-route="reviews.index"
        class="max-w-lg"
        class-pagination="mt-10"
        class-item="mb-6"
        @changed="params => fetchReviews(params)"
      />
    </div>
    <EmptyList v-else>
      Review list is empty
    </EmptyList>
  </div>
</template>

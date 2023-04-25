<script setup>
import { reactive, watch } from 'vue'
import { useRoute } from 'vue-router'
import http from '@/http'
import { useMeta } from '@/plugins/meta'
import ReviewCard from '@/components/Review/ReviewCard.vue'
import Headline from '@/components/Headline.vue'
import Pagination from '@/components/Pagination.vue'
import EmptyList from '@/components/EmptyList.vue'

const route = useRoute()

const reviews = reactive({
  meta: {},
  items: [],
})

const fetchReviews = async () => {
  const response = await http.get('/api/reviews', {
    params: {
      page: route.query.page || 1,
    }
  })

  reviews.meta = response.data.meta
  reviews.items = response.data.data
}

useMeta().setTitle('Reviews')

await fetchReviews()

watch(() => route.query.page, () => {
  if (route.name === 'reviews.index') {
    fetchReviews()
  }
})
</script>

<template>
  <div>
    <Headline icon="comments" class="!mb-10">Reviews</Headline>
    <div class="mb-4">
      Total: {{ reviews.meta.total }}
    </div>
    <div v-if="reviews.items.length">
      <div class="max-w-lg">
        <ReviewCard
          v-for="review in reviews.items"
          :key="review.id"
          :review="review"
          class="mb-6"
        />
      </div>
      <Pagination
        :total="reviews.meta.total"
        :per="reviews.meta.per_page"
        class="mt-10"
      />
    </div>
    <EmptyList v-else>
      Review list is empty
    </EmptyList>
  </div>
</template>

<script setup>
import { ref, reactive } from 'vue'
import { useRoute } from 'vue-router'
import http from '@/http'
import RatingBar from '@/components/RatingBar.vue'
import Headline from '@/components/Headline.vue'
import Card from '@/components/Reviews/Card.vue'

const route = useRoute()
const game = ref({})
const reviews = reactive({
  meta: {},
  items: [],
})

const fetchGame = async () => {
  const response = await http.get(`/api/games/${route.params.slug}`)

  game.value = response.data.data
}

const fetchReviews = async () => {
  const response = await http.get('/api/reviews', {
    params: {
      game_id: game.value.id,
    }
  })

  reviews.meta = response.data.meta
  reviews.items = response.data.data
}

await fetchGame()
fetchReviews()

</script>

<template>
  <div>
    <div class="flex">
      <img :src="game.cover_url" :alt="game.title" class="w-56 mr-7 rounded shadow-xl" />
      <div class="pt-2">
        <div class="flex mb-6">
          <span class="mr-2 text-2xl">{{ game.title }}</span>
          <span v-if="game.year">{{ game.year }}</span>
        </div>
        <div class="mb-6">
          <RouterLink
            v-for="genre in game.genres || []"
            :key="genre.id"
            :to="{ name: 'games.index' }"
            class="inline-block mb-2 py-1 px-2 mr-2 rounded text-xs bg-sky-700 hover:text-primary hover:bg-sky-500"
          >
            {{ genre.title }}
          </RouterLink>
        </div>
        <div class="mb-6 flex items-center">
          <RatingBar :rating="game.rating" class="text-2xl mr-10" />
          <div>
            <button class="py-1 px-4 rounded bg-green-600">
              <span v-if="game.price">
                {{ game.price.formatted + game.price.sign }}
              </span>
              <span v-else>
                FREE
              </span>
            </button>
          </div>
        </div>
        <div v-html="game.description" class="mb-6 max-w-md"></div>
      </div>
    </div>
    <div class="mt-12 pl-3 max-w-lg">
      <Headline icon="comments" class="-ml-3 flex items-center">
        <span class="mr-2">Reviews</span>
        <span class="text-base text-secondary whitespace-nowrap">( {{ reviews.meta.total || 0 }} )</span>
      </Headline>
      <div v-if="reviews.items.length">
        <Card
          v-for="review in reviews.items"
          :key="review.id"
          :review="review"
          class="mb-6"
        />
      </div>
    </div>
  </div>
</template>

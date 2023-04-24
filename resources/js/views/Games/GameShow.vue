<script setup>
import { ref, reactive } from 'vue'
import { useRoute } from 'vue-router'
import http from '@/http'
import { useAuthStore } from '@/stores/auth'
import { useMeta } from '@/plugins/meta'
import RatingBar from '@/components/Rating/RatingBar.vue'
import Headline from '@/components/Headline.vue'
import ReviewCard from '@/components/Reviews/ReviewCard.vue'
import ReviewCreateForm from '@/components/Reviews/ReviewCreateForm.vue'

const route = useRoute()
const authStore = useAuthStore()
const game = ref({})
const reviews = reactive({
  meta: {},
  items: [],
})

const toggleWishlistLock = ref(false)
const showReviewForm = ref(false)

const fetchGame = async () => {
  const response = await http.get(`/api/games/${route.params.slug}`)

  game.value = response.data.data
}

const fetchReviews = async () => {
  const response = await http.get(`/api/games/${game.value.id}/reviews`)

  reviews.meta = response.data.meta
  reviews.items = response.data.data

  if (!reviews.items.length) {
    showReviewForm.value = true
  }
}

const toggleWishlist = async () => {
  if (authStore.can()) {
    toggleWishlistLock.value = true

    await http.post(`/api/wishlist/toggle/${game.value.id}`)

    toggleWishlistLock.value = false

    game.value.has_wishlist = !game.value.has_wishlist
  }
}

const toggleReviewForm = () => {
  if (authStore.can()) {
    showReviewForm.value = !showReviewForm.value
  }
}

const onReviewCreated = () => {
  fetchReviews()
  showReviewForm.value = false
}

useMeta().setTitle(game.value.title)

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
            :to="{ name: 'games.index', query: { genres: genre.id } }"
            class="inline-block mb-2 py-1 px-2 mr-2 rounded text-xs bg-sky-700 hover:text-primary hover:bg-sky-500"
          >
            {{ genre.title }}
          </RouterLink>
        </div>
        <div class="mb-6 flex items-center">
          <RatingBar v-if="game.rating" :rating="game.rating" class="text-2xl mr-10" />
          <div class="mr-6">
            <button class="py-1 px-4 rounded bg-green-600">
              <span v-if="game.price">
                {{ game.price.formatted + game.price.sign }}
              </span>
              <span v-else>
                FREE
              </span>
            </button>
          </div>
          <div>
            <button
              class="button-wishlist py-1 px-4 border border-white border-opacity-40 rounded hover:bg-pink-700 hover:border-pink-500 transition"
              :class="{ 'bg-pink-700 border-pink-500': game.has_wishlist }"
              :disabled="toggleWishlistLock"
              @click="toggleWishlist()"
            >
              <font-awesome-icon icon="heart" />
              <span v-if="!game.has_wishlist" class="ml-2">Add to wishlist</span>
              <span v-else class="ml-2 hidden" data-label="remove">Remove from wishlist</span>
            </button>
          </div>
        </div>
        <div v-html="game.description" class="mb-6 max-w-md"></div>
      </div>
    </div>
    <div class="mt-12 pl-3 max-w-lg">
      <div class="flex justify-between items-center mb-4">
        <Headline icon="comments" class="-ml-3 !mb-0 flex items-center">
          <div>
            <span class="mr-2">Reviews</span>
            <span class="text-base text-secondary whitespace-nowrap">( {{ reviews.meta.total || 0 }} )</span>
          </div>
        </Headline>
        <button
          class="button primary"
          :class="{ 'active': showReviewForm }"
          @click="toggleReviewForm()"
        >
          <font-awesome-icon icon="bullhorn" class="mr-2" />
          <span v-show="!showReviewForm">Write a review</span>
          <span v-show="showReviewForm">Close review form</span>
        </button>
      </div>
      <div v-show="showReviewForm" class="mt-6 mb-10">
        <ReviewCreateForm
          :game="game"
          @review-created="onReviewCreated"
        />
      </div>
      <div v-if="reviews.items.length">
        <ReviewCard
          v-for="review in reviews.items"
          :key="review.id"
          :review="review"
          class="mb-6"
        />
      </div>
    </div>
  </div>
</template>

<style scoped>
.button-wishlist:hover [data-label="remove"] {
  @apply inline;
}
</style>

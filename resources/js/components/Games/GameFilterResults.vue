<script setup>
import { reactive, ref } from 'vue'
import { useRouter, useRoute } from 'vue-router'
import http from '@/http'
import { useGameFilterStore } from '@/stores/game-filter'
import GameCard from '@/components/Games/GameCard.vue'
import AsyncLoading from '@/components/AsyncLoader/AsyncLoading.vue'

const filterStore = useGameFilterStore()
const router = useRouter()
const route = useRoute()

const games = reactive({
  meta: {},
  items: [],
})

const loadMore = async () => {
  await fetchGames({ cursor: games.meta.next_cursor })
}

const fetchGames = async (params = {}) => {
  if (filterStore.loading) {
    return
  }

  params = Object.assign({}, {
    genres: filterStore.$state.genres.join(','),
    is_free: filterStore.$state.is_free ? 1 : 0,
    search: filterStore.$state.search,
  }, params)

  filterStore.$patch({ loading: true })

  const response = await http.get('/api/games', { params })

  setTimeout(() => filterStore.$patch({ loading: false }), 300)

  const query = Object
    .entries(Object.assign({}, params, { cursor: null }))
    .reduce((a, [key, val]) => (val ? (a[key] = val, a) : a), {})

  router.replace({ name: 'games.index', query })

  games.meta = response.data.meta
  games.items = params.cursor
    ? games.items.concat(response.data.data)
    : response.data.data
}

await fetchGames()

filterStore.$subscribe((mutation) => {
  if (!mutation.payload || 'loading' in mutation.payload === false) {
    fetchGames()
  }
})
</script>

<template>
  <div>
    <div class="mb-4 text-base">
      {{ games.items.length }} games displayed
    </div>
    <div class="relative">
      <div class="flex flex-wrap transition" :class="{ 'blur-sm pointer-events-none grayscale-[50%]': filterStore.loading }">
        <GameCard v-for="game in games.items" :key="game.id" :game="game" />
      </div>
      <div v-show="filterStore.loading" class="absolute top-10 bottom-0 left-0 right-0 flex items-start justify-center z-10">
        <AsyncLoading class="sticky top-10" />
      </div>
    </div>
    <div v-if="games.meta.next_cursor" class="flex justify-center pt-6 pb-10">
      <button
        :disabled="filterStore.loading"
        @click="loadMore"
        class="inline-block py-2 px-4
          border border-primary border-opacity-50 rounded
          transition hover:border-sky-400 hover:bg-sky-600
          disabled:border-primary disabled:border-opacity-50 disabled:bg-transparent"
      >
        <font-awesome-icon icon="angles-down" class="mr-2" />
        <span class="mr-2">Load more</span>
        <font-awesome-icon icon="angles-down" />
      </button>
    </div>
  </div>
</template>

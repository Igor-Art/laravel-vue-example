<script setup>
import { reactive, ref } from 'vue'
import http from '@/http'
import { useGameFilterStore } from '@/stores/game-filter'
import GameCard from '@/components/Games/Card.vue'
import AsyncLoading from '@/components/AsyncLoader/Loading.vue'

const filterStore = useGameFilterStore()

const loading = ref(false)

const games = reactive({
  meta: {},
  items: [],
})

const loadMore = async () => {
  const response = await fetchGames({
    cursor: games.meta.next_cursor,
  })

  games.meta = response.meta
  games.items = games.items.concat(response.items)
}

const load = async (params = {}) => {
  const response = await fetchGames(params)

  games.meta = response.meta
  games.items = response.items
}

const fetchGames = async (params = {}) => {
  params = Object.assign({}, {
    genres: filterStore.$state.genres.map(item => item.id).join(','),
    is_free: filterStore.$state.is_free ? 1 : 0,
    search: filterStore.$state.search,
  }, params)


  loading.value = true

  const response = await http.get('/api/games', { params })

  setTimeout(() => loading.value = false, 300)

  return {
    meta: response.data.meta,
    items: response.data.data,
  }
}

await load()

filterStore.$subscribe(() => load())
</script>

<template>
  <div>
    <div class="mb-4 text-base">
      {{ games.items.length }} games displayed
    </div>
    <div class="relative">
      <div class="flex flex-wrap transition" :class="{ 'blur-sm grayscale-[50%]': loading }">
        <GameCard v-for="game in games.items" :key="game.id" :game="game" />
      </div>
      <div v-show="loading" class="absolute top-10 bottom-0 left-0 right-0 flex justify-center z-10">
        <AsyncLoading />
      </div>
    </div>
    <div v-if="games.meta.next_cursor" class="flex justify-center pt-6 pb-10">
      <button @click="loadMore" class="inline-block py-2 px-4 border border-primary border-opacity-50 rounded transition hover:border-sky-400 hover:bg-sky-600">
        <font-awesome-icon icon="angles-down" class="mr-2" />
        <span class="mr-2">Load more</span>
        <font-awesome-icon icon="angles-down" />
      </button>
    </div>
  </div>
</template>

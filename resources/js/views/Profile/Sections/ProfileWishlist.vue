<script setup>
import { useRoute } from 'vue-router'
import http from '@/http'
import { reactive } from 'vue'
import GameCard from '@/components/Game/GameCard.vue'
import PaginatedList from '@/components/Lists/PaginatedList.vue'

const route = useRoute()

const games = reactive({
  meta: {},
  items: [],
})

const fetchGames = async (params = {}) => {
  const response = await http.get(`/api/users/${route.params.id}/wishlist`, { params })

  games.meta = response.data.meta
  games.items = params.cursor
    ? games.items.concat(response.data.data)
    : response.data.data
}

await fetchGames()
</script>

<template>
  <div>
    <PaginatedList
      v-if="games.items.length"
      :component="GameCard"
      :items="games.items"
      :meta="games.meta"
      item-prop-name="game"
      scope-route="profile.show.wishlist"
      class="flex flex-wrap mb-6"
      class-pagination="flex justify-center"
      @changed="params => fetchGames(params)"
    />
    <div v-else>
      Wishlist is empty
    </div>
  </div>
</template>

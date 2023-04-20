<script setup>
import { reactive } from 'vue'
import http from '@/http'
import GameCard from '@/components/Games/GameCard.vue'

const games = reactive({
  items: [],
})

const fetchGames = async () => {
  const response = await http.get('/api/games/top')

  games.items = response.data.data
}

await fetchGames()
</script>

<template>
  <div>
    <div class="flex flex-wrap -mx-1">
      <GameCard
        v-for="item in games.items"
        :key="item.id"
        :game="item"
      />
    </div>
  </div>
</template>


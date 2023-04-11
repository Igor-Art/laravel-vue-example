<script setup>
import { onMounted, reactive } from 'vue'
import http from '@/http'
import GameCard from '@/components/Games/Card.vue'

const games = reactive({
  items: [],
})

function fetchGames () {
  http
    .get('/api/games/top')
    .then((response) => {
      games.items = response.data.data
    })
    .catch(() => {})
    .finally(() => {})
}

onMounted(() => {
  fetchGames()
})
</script>

<template>
  <div class="flex flex-wrap">
    <GameCard v-for="item in games.items" :key="item.id" :game="item" />
  </div>
</template>


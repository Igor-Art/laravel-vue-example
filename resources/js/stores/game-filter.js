import { defineStore } from 'pinia'
import { useRoute } from 'vue-router'
import { ref } from 'vue'

export const useGameFilterStore = defineStore('gameFilter', () => {
  const route = useRoute()

  const genres = ref(
    route.query.genres
      ? route.query.genres
        .split(',')
        .splice(0, 5)
        .map(id => +id)
      : []
  )

  const search = ref(route.query.search || '')
  const is_free = ref(route.query.is_free ? true : false)
  const loading = ref(false)

  return {
    genres,
    search,
    is_free,
    loading,
  }
})

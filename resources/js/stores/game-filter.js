import { defineStore } from 'pinia'
import { ref } from 'vue'

export const useGameFilterStore = defineStore('gameFilter', () => {
  const genres = ref([])
  const search = ref('')
  const is_free = ref(false)
  const loading = ref(false)

  function initFilter(params) {
    genres.value = params.genres
      ? params.genres
        .split(',')
        .splice(0, 5)
        .map(id => +id)
      : []

    search.value = params.search && params.search.length > 2 ? params.search : ''
    is_free.value = params.is_free ? true : false
  }

  return {
    genres,
    search,
    is_free,
    loading,
    initFilter,
  }
})

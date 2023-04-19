import { defineStore } from 'pinia'

export const useGameFilterStore = defineStore({
  id: 'gameFilter',

  state: () => ({
    genres: [],
    search: '',
    is_free: false,
    loading: false,
  }),

  getters: {
    //
  },

  actions: {
    //
  }
})

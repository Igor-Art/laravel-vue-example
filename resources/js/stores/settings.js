import { defineStore } from 'pinia'

export const useSettingsStore = defineStore({
  id: 'settings',

  state: () => (
    JSON.parse(document.getElementById('app').getAttribute('data-settings'))
  ),

  getters: {
    //
  },

  actions: {
    //
  }
})

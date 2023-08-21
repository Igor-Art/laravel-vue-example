import { defineStore } from 'pinia'

export const useModalsStore = defineStore({
  id: 'modals',

  state: () => ({
    stack: [],
    registry: [],
  }),

  getters: {
    //
  },

  actions: {
    uniqueId (id = '') {
      if (!id || this.registry.includes(id)) {
        return this.uniqueId(id + Math.random().toString(16).slice(2))
      }

      this.registry.push(id)

      return id
    },
    open (id) {
      if (this.stack.includes(id)) {
        return
      }

      this.stack.unshift(id)
    },
    close (id) {
      if (!id) {
        this.stack.shift()
        return
      }

      if (!this.stack.includes(id)) {
        return
      }

      this.stack.splice(this.stack.indexOf(id), 1)
    },
    closeAll () {
      this.stack = []
    },
    turn (id, status) {
      if (status) {
        this.open(id)
      } else {
        this.close(id)
      }
    }
  }
})

export const useModal = (id) => new class {
  constructor () {
    this.store = useModalsStore()
    this.id = this.store.uniqueId(id)
  }

  open () {
    this.store.open(this.id)
  }

  close () {
    this.store.close(this.id)
  }

  turn (status) {
    this.store.turn(this.id, status)
  }

  getId () {
    return this.id
  }
}

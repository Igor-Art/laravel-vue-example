import { inject, onActivated, onMounted } from 'vue'

const metaKey = Symbol((process.env.NODE_ENV !== 'production') ? 'meta' : '')

const Meta = {
  instance: {
    options: {
      prefix: '',
      separator: '»',
    },
    setTitle(title) {
      this.refresh(() => document.title = this.compileTitle(title))

      return this
    },
    compileTitle (title) {
      return title ? `${title} ${this.options.separator} ${this.options.prefix}` : this.options.prefix
    },
    refresh(callback) {
      onMounted(() => callback())
      onActivated(() => callback())
    },
  },
  install(app, options) {
    this.instance.options = Object.assign(this.instance.options, options)

    app.provide(metaKey, this.instance)
  }
}

function useMeta() {
  return inject(metaKey)
}

export { Meta, useMeta }

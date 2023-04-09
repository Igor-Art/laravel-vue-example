import { createApp } from 'vue'
import { createPinia } from 'pinia'

import router from '@/router'
import App from '@/App.vue'

import '@/../css/app.css'

const main = createApp(App)

main.use(createPinia())
main.use(router)

main.mount('#app')

import { createApp } from 'vue'
import { createPinia } from 'pinia'
import Toast from 'vue-toastification'

import router from '@/router'
import App from '@/App.vue'
import ToastConfig from '@/config/toast'

import 'vue-toastification/dist/index.css'
import '@/../css/app.css'

const app = createApp(App)

app.use(createPinia())
app.use(router)

app.use(Toast, ToastConfig)

app.mount('#app')

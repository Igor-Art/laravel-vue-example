import { createApp } from 'vue'
import { createPinia } from 'pinia'
import Toast from 'vue-toastification'

import App from '@/App.vue'
import router from '@/router'
import ToastConfig from '@/config/toast'
import FontAwesomeIcon from '@/plugins/font-awesome'

import 'vue-toastification/dist/index.css'
import '@/../css/app.css'

const app = createApp(App)

app.use(createPinia())
app.component('font-awesome-icon', FontAwesomeIcon)
app.use(router)
app.use(Toast, ToastConfig)

app.mount('#app')

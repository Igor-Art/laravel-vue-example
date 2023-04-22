import { createApp } from 'vue'
import { createPinia } from 'pinia'
import Toast from 'vue-toastification'

import App from '@/App.vue'
import router from '@/router'
import ToastConfig from '@/config/toast'
import FontAwesomeIcon from '@/plugins/font-awesome'
import Date from '@/plugins/date'
import { Meta } from '@/plugins/meta'

import 'vue-toastification/dist/index.css'
import '@/../css/app.css'

const app = createApp(App)

app.use(createPinia())
app.component('font-awesome-icon', FontAwesomeIcon)
app.use(router)
app.use(Meta, { prefix: document.title })
app.use(Toast, ToastConfig)
app.use(Date)

app.mount('#app')

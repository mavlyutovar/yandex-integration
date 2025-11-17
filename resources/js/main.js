import { createApp } from 'vue'
import App from './App.vue'
import router from '../router/index'
import 'sanitize.css'
import 'sanitize.css/forms.css'
import 'sanitize.css/typography.css'
import axios from 'axios'

axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'
axios.defaults.headers.common['X-CSRF-TOKEN'] =
    document.querySelector('meta[name="csrf-token"]').getAttribute('content')

const app = createApp(App)
app.use(router)
app.mount('#app')

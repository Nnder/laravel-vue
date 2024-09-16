import './assets/main.css'

import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import store from './store/store'
import axios from 'axios'
import ToastPlugin from 'vue-toast-notification'
import 'vue-toast-notification/dist/theme-bootstrap.css'

// Vuetify
import 'vuetify/styles' // Import Vuetify styles
import { createVuetify } from 'vuetify' // Import Vuetify
import * as components from 'vuetify/components' // Import components
import * as directives from 'vuetify/directives' // Import directives
import 'vuetify/styles' // Import Vuetify CSS styles
import '@mdi/font/css/materialdesignicons.css'

const vuetify = createVuetify({
  components,
  directives
})

const app = createApp(App)

app.use(router)
app.use(store)
app.use(vuetify)
app.use(ToastPlugin)

app.mount('#app')

const url = import.meta.env.VITE_BACKEND_URL
axios.defaults.baseURL = url

axios
  .get('/sanctum/csrf-cookie')
  .then((response) => {
    console.log('CSRF cookie set')
  })
  .then(() => {
    const token = localStorage.getItem('token')
    if (token) {
      axios.defaults.headers.common['Authorization'] = `Bearer ${token}`
      store.dispatch('fetchUser', { token })
      console.log(token)
    }
  })

axios.defaults.withCredentials = true
axios.defaults.withXSRFToken = true

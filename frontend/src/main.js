import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import './assets/tailwind.css'
import setAuthHeader from './services/setAuthHeader'

if(localStorage.bearerToken) {
    setAuthHeader(localStorage.bearerToken)
} else {
    setAuthHeader(false)
}

createApp(App).use(router).mount('#app')

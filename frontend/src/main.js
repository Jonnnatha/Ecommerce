import { createApp } from 'vue'
import {createPinia} from 'pinia'
import './style.css'
import './template.js'

import router from "./router"
import App from './App.vue'

import ElementPlus from 'element-plus'

import piniaPluginPersistedstate from 'pinia-plugin-persistedstate'

const pinia = createPinia();
const app = createApp(App)
pinia.use(piniaPluginPersistedstate)

    app.use(router)
    app.use(pinia)
    app.use(ElementPlus)
    app.mount('#app')

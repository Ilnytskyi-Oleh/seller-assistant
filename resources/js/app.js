import { createApp } from 'vue'
import { createPinia } from 'pinia'

import App from './App.vue'
import router from './router'

import '../css/main.css'

// Init Pinia
const pinia = createPinia()

// Create Vue app
let app = createApp(App);
app.use(pinia)
app.use(router)
app.mount('#app')

// Dark mode
// Uncomment, if you'd like to restore persisted darkMode setting, or use `prefers-color-scheme: dark`. Make sure to uncomment localStorage block in src/stores/darkMode.js
import { useDarkModeStore } from './stores/darkMode'
import {useUploadStore} from "@/stores/upload.js";

const darkModeStore = useDarkModeStore(pinia)

if (
    (!localStorage['darkMode'] && window.matchMedia('(prefers-color-scheme: dark)').matches) ||
    localStorage['darkMode'] === '1'
) {
    darkModeStore.set(true)
}
// Default title tag
const defaultDocumentTitle = '=_='

// Set document title from route meta
router.afterEach((to) => {
  document.title = to.meta?.title
    ? `${to.meta.title} — ${defaultDocumentTitle}`
    : defaultDocumentTitle
})

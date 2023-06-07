//# sourceURL=main.js

import './style.css'
import { createApp } from 'vue'
import { createPinia } from 'pinia'
//import { router } from '@routes/index.js';




import Root from './app.vue'
import config from '../../conf/client.config.json' assert { type: 'json' };


const pinia = createPinia();
const app = createApp(Root).use(pinia);


app.config.globalProperties.$config = config;

document.addEventListener('DOMContentLoaded', () => app.mount('#app'));

window.config = config;
window.pinia = pinia;

export { config }

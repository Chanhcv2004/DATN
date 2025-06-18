import { createApp } from 'vue'
import App from './App.vue'
import './assets/css/style.css'
import router from './router/index.js'

import '../node_modules/bootstrap/dist/css/bootstrap-grid.min.css'
import '../node_modules/bootstrap/dist/css/bootstrap-utilities.min.css'

const app = createApp(App);
app.use(router);
app.mount('#app');

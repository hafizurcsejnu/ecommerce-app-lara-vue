import { createApp } from 'vue'
import App from './App.vue'
//import {store} from './store'

import routes from './routes/routes'

createApp(App).use(routes).mount('#app')

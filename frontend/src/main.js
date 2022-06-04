import Vue from 'vue'
import vuetify from './plugins/vuetify'

import App from './App.vue'
import router from './router'
import store from './store'

import VueProgressBar from 'vue-progressbar'
import VueProgressBarColors from './plugins/vue-progress-bar-colors'

import './plugins/vuelidate'
import './plugins/moment'

Vue.use(VueProgressBar, VueProgressBarColors)

Vue.config.productionTip = false

new Vue({
  vuetify,
  router,
  store,
  render: h => h(App)
}).$mount('#app')

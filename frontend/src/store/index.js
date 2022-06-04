import Vue from 'vue'
import Vuex from 'vuex'

import core from './modules/core'
import dialog from './modules/dialog'
import snackbar from './modules/snackbar'
import httpException from './modules/http-exception'

import user from './models/user'

Vue.use(Vuex)

export default new Vuex.Store({
  modules: {
    core,
    dialog,
    snackbar,
    httpException,

    user
  }
})

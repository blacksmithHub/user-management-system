/**
 * ==========================
 * Snackbar Store
 * ==========================
 *
 * Handles the snackbar of the application.
 *
 * ==========================
 */
export default {
  namespaced: true,
  strict: process.env.APP_ENV === 'development',
  state () {
    return {
      timeout: null,
      top: false,
      bottom: true,
      right: true,
      left: false,
      multiLine: false,
      vertical: false,
      snackbar: false,
      color: '',
      message: ''
    }
  },
  mutations: {
    /**
     * Sets the default values for snackbar.
     *
     * @param state
     */
    setDefault (state) {
      state.timeout = 3000
      state.top = document.documentElement.clientWidth <= 960 || false
      state.bottom = document.documentElement.clientWidth >= 960 || true
      state.right = true
      state.left = false
      state.multiLine = document.documentElement.clientWidth <= 960 || false
      state.vertical = document.documentElement.clientWidth <= 960 || false
      state.snackbar = false
      state.color = ''
      state.message = ''
    },
    /**
     * Overrides snackbar properties.
     *
     * @param state
     * @param config
     */
    setSnackbar (state, config) {
      for (const key in config) {
        state[key] = config[key]
      }

      state.snackbar = true
    }
  },
  actions: {
    /**
     * Shows the snackbar and overrides some properties.
     *
     * @param context
     * @param config
     */
    showSnackbar (context, config) {
      context.commit('setDefault')
      context.commit('setSnackbar', config)
    },
    /**
     * Hides the snackbar in view.
     *
     * @param context
     */
    closeSnackbar (context) {
      context.commit('setDefault')
    }
  }
}

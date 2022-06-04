/**
 * =====================================================
 * Core store
 * =====================================================
 *
 * Handles core states and behavior of the application.
 *
 * =====================================================
 */
const data = {
  loading: false
}

export default {
  namespaced: true,
  state () {
    return {
      ...data
    }
  },
  mutations: {
    /**
     * Set the loading.
     *
     * @param state
     * @param loading
     */
    SET_LOADING (state, loading) {
      state.loading = loading
    }
  },
  actions: {
    /**
     * Set the loading state
     *
     * @param {*} param
     * @param {*} loading
     */
    setLoading ({ commit }, loading) {
      commit('SET_LOADING', loading)
    }
  }
}

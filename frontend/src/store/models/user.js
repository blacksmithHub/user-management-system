import User from '@/api/user'

export default {
  namespaced: true,
  state () {
    return {
      data: {},
      loading: false
    }
  },
  getters: {
    /**
     * Check if state has a user data
     */
    hasData: state => {
      return !!Object.keys(state.data).length
    }
  },
  mutations: {
    /**
     * Set the loading state.
     *
     * @param {*} state
     * @param {*} loading
     */
    SET_LOADING (state, loading) {
      state.loading = loading
    },

    /**
     * Set the item.
     *
     * @param {*} state
     * @param {*} data
     */
    SET_DATA (state, data) {
      state.data = data
    }
  },
  actions: {
    /**
     * Get the user records.
     *
     * @param {*} params
     */
    fetch ({ commit, dispatch }, params) {
      commit('SET_LOADING', true)

      return User.index(params)
        .then(({ data }) => {
          commit('SET_DATA', data)

          return data
        })
        .catch(({ response }) => dispatch('httpException/handle', response, { root: true }))
        .finally(() => commit('SET_LOADING', false))
    },

    /**
     * Delete the user records.
     *
     * @param {*} params
     */
    delete ({ commit, dispatch }, params) {
      commit('SET_LOADING', true)

      return User.destroy(params)
        .then(({ data }) => {
          dispatch('fetch', { page: 1, per_page: 10 })

          return data
        })
        .catch(({ response }) => dispatch('httpException/handle', response, { root: true }))
        .finally(() => commit('SET_LOADING', false))
    }
  }
}

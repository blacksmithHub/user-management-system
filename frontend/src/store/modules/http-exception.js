import auth from '@/services/auth'

const config = { root: true }

const data = {
  error: null
}

/**
 * ===============================================
 * HTTP Exception Store
 * ===============================================
 *
 * Handles HTTP exceptions by prompting users.
 *
 * ===============================================
 */
export default {
  namespaced: true,
  state () {
    return {
      ...data
    }
  },
  mutations: {
    /**
     * Reset the state to default.
     *
     * @param {*} state
     */
    RESET (state) {
      for (const key in state) {
        state[key] = data[key]
      }
    },

    /**
     * Set the state error.
     *
     * @param {*} state
     * @param {*} error
     */
    SET_ERROR (state, error) {
      state.error = error
    }
  },
  actions: {
    /**
     * Determine the appropriate action for the error
     *
     * @param error
     */
    handle ({ commit, dispatch }, error) {
      if (!error) return dispatch('criticalError')

      commit('SET_ERROR', error)

      switch (error.status) {
        case 401:
          return dispatch('unauthenticated')

        case 403:
          return dispatch('unauthorized')

        case 404:
          return dispatch('notFound')

        case 422:
          return dispatch('unprocessable')

        case 429:
          return dispatch('tooManyRequestsError')

        case 500:
          return dispatch('internalServerError')

        default:
          return dispatch('defaultError')
      }
    },

    /**
     * Handles critical error without response.
     *
     */
    criticalError ({ commit }) {
      const data = {
        title: 'Server Error',
        body: 'We have encountered issues with our server, and our team is working on it. Apologies for any inconvenience this may have caused.'
      }

      commit('dialog/OPEN_ALERT_DIALOG', data, config)
    },

    /**
     * Shows an alert dialog with the error status from response.
     *
     */
    defaultError ({ commit, state }) {
      const data = {
        title: state.error.statusText,
        body: state.error.data.message
      }

      commit('dialog/OPEN_ALERT_DIALOG', data, config)
    },

    /**
     * Shows an alert dialog with a status of 500.
     *
     */
    internalServerError ({ commit, state }) {
      const data = {
        title: 'Oops! Something went wrong.',
        body: state.error.data.message
      }

      commit('dialog/OPEN_ALERT_DIALOG', data, config)
    },

    /**
     * Shows an alert dialog with a status of 404.
     *
     */
    notFound ({ commit, state }) {
      const data = {
        title: 'The requested resource was not found.',
        body: state.error.data.message
      }

      commit('dialog/OPEN_ALERT_DIALOG', data, config)
    },

    /**
     * Shows an alert dialog with a status of 401.
     *
     */
    unauthenticated ({ commit, state }) {
      const data = {
        title: 'Please login to continue.',
        body: state.error.data.message,
        action: () => {
          auth.flush()
          sessionStorage.clear()
          window.location.replace(`${window.location.origin}/login`)
        }
      }

      commit('dialog/OPEN_ALERT_DIALOG', data, config)
    },

    /**
     * Shows an alert dialog with a status of 403.
     *
     */
    unauthorized ({ commit, state }) {
      const data = {
        title: 'Forbidden',
        body: state.error.data.message
      }

      commit('dialog/OPEN_ALERT_DIALOG', data, config)
    },

    /**
     * Shows an alert dialog with a status of 422.
     *
     */
    unprocessable ({ commit, state }) {
      const data = {
        title: 'There was an error with your request.',
        body: state.error.data.message
      }

      commit('dialog/OPEN_ALERT_DIALOG', data, config)
    },

    /**
     * Shows an alert dialog with a status of 429.
     *
     */
    tooManyRequestsError ({ commit, state }) {
      const data = {
        title: 'Too many requests.',
        body: state.error.data.message
      }

      commit('dialog/OPEN_ALERT_DIALOG', data, config)
    }
  }
}

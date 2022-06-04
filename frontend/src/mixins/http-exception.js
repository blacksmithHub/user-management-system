import { mapActions } from 'vuex'

import auth from '@/services/auth'

/**
 * ===============================================
 * HTTP Exception Mixin
 * ===============================================
 *
 * Handles HTTP exceptions by prompting users.
 * Imported by components that uses APIs, and
 * called in the .catch() fallback of HTTP calls.
 *
 * ===============================================
 */

export default {
  data () {
    return {
      error: null
    }
  },
  methods: {
    ...mapActions('dialog', ['openAlertDialog']),

    /**
     * Handles critical error without response.
     *
     */
    criticalError () {
      this.openAlertDialog({
        title: 'Server Error',
        body: 'We have encountered issues with our server, and our team is working on it. Apologies for any inconvenience this may have caused.'
      })
    },

    /**
     * Determine the appropriate action for the error
     *
     * @param error
     */
    handle (error) {
      if (!error) return this.criticalError()

      this.setError(error)

      switch (error.status) {
        case 401:
          return this.unauthenticated()

        case 403:
          return this.unauthorized()

        case 404:
          return this.notFound()

        case 422:
          return this.unprocessable()

        case 429:
          return this.tooManyRequestsError()

        case 500:
          return this.internalServerError()

        default:
          return this.defaultError()
      }
    },

    /**
     * Parse error string if error is not yet an object
     *
     * @param error
     */
    setError (error) {
      if (typeof error !== 'object') error.error = JSON.parse(error.error)
      this.error = error
    },

    /**
     * Shows an alert dialog with the error status from response.
     *
     */
    defaultError () {
      this.openAlertDialog({
        title: this.error.statusText,
        body: this.error.message
      })
    },

    /**
     * Shows an alert dialog with a status of 500.
     *
     */
    internalServerError () {
      this.openAlertDialog({
        title: 'Oops! Something went wrong.',
        body: this.error.data.message
      })
    },

    /**
     * Shows an alert dialog with a status of 404.
     *
     */
    notFound () {
      this.openAlertDialog({
        title: 'The requested resource was not found.',
        body: this.error.data.message
      })
    },

    /**
     * Shows an alert dialog with a status of 401.
     *
     */
    unauthenticated () {
      this.openAlertDialog({
        title: 'Please login to continue.',
        body: this.error.data.message,
        action: () => {
          auth.flush()
          window.location.replace(`${window.location.origin}/login`)
          sessionStorage.clear()
        }
      })
    },

    /**
     * Shows an alert dialog with a status of 403.
     *
     */
    unauthorized () {
      this.openAlertDialog({
        title: 'Forbidden',
        body: this.error.data.message
      })
    },

    /**
     * Shows an alert dialog with a status of 422.
     *
     */
    unprocessable () {
      this.openAlertDialog({
        title: 'There was an error with your request.',
        body: this.error.data.message
      })
    },

    /**
     * Shows an alert dialog with a status of 429.
     *
     */
    tooManyRequestsError () {
      this.openAlertDialog({
        title: 'Too many requests.',
        body: this.error.data.message
      })
    }
  }
}

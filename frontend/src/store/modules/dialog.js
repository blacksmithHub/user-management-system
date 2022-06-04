/**
 * =======================================
 * Dialog Store
 * =======================================
 *
 * Handles the dialogs of the application.
 *
 * =======================================
 */
export default {
  namespaced: true,
  strict: process.env.APP_ENV === 'development',
  state () {
    return {
      alertDialog: false,
      confirmationDialog: false,
      id: null,
      title: '',
      body: '',
      action: null,
      actionLabel: '',
      cancel: null,
      cancelLabel: '',
      maxWidth: 500,
      color: ''
    }
  },
  mutations: {
    /**
     * Shows the alert dialog.
     *
     * @param state
     * @param param1
     */
    OPEN_ALERT_DIALOG (state, { title, body, action, actionLabel, maxWidth }) {
      state.title = title
      state.body = body
      state.actionLabel = actionLabel || 'Got It!'
      state.action = action
      state.alertDialog = true
      state.maxWidth = maxWidth || 500
    },

    /**
     * Shows the confirmation dialog.
     *
     * @param state
     * @param param1
     */
    OPEN_CONFIRMATION_DIALOG (state, { title, body, action, actionLabel, cancel, cancelLabel, color }) {
      state.title = title
      state.body = body
      state.actionLabel = actionLabel
      state.cancelLabel = cancelLabel
      state.action = action
      state.cancel = cancel
      state.confirmationDialog = true
      state.color = color || 'primary'
    },

    /**
     * Hides the dialog in view.
     *
     * @param state
     * @param dialog
     */
    CLOSE_DIALOG (state, dialog) {
      state[dialog] = false
      state.title = false
      state.id = null
      state.title = ''
      state.body = ''
      state.actionLabel = ''
      state.cancelLabel = ''
    }
  },
  actions: {
    /**
     * Shows the alert dialog.
     *
     * @param context
     * @param config
     */
    openAlertDialog (context, config) {
      context.commit('OPEN_ALERT_DIALOG', config)
    },

    /**
     * Shows the confirmation dialog.
     *
     * @param context
     * @param config
     */
    openConfirmationDialog (context, config) {
      context.commit('OPEN_CONFIRMATION_DIALOG', config)
    },

    /**
     * Close the dialog in view.
     *
     * @param context
     */
    closeDialog (context, config) {
      context.commit('CLOSE_DIALOG', config)
    }
  }
}

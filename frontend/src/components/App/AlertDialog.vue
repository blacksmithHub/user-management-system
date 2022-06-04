<template>
  <v-dialog
    :value="alertDialog"
    persistent
    :max-width="maxWidth"
    scrollable
  >
    <v-card>
      <v-card-title class="title">
        {{ title }}
      </v-card-title>

      <v-card-text>{{ body }}</v-card-text>

      <v-card-actions>
        <v-container class="text-center">
          <v-btn
            rounded
            @click="closeAndAgree()"
          >
            {{ actionLabel }}
          </v-btn>
        </v-container>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
import { mapActions, mapState } from 'vuex'

export default {
  name: 'AppAlertDialog',
  computed: {
    ...mapState('dialog', [
      'alertDialog',
      'title',
      'body',
      'action',
      'actionLabel',
      'maxWidth'
    ])
  },
  methods: {
    ...mapActions('dialog', ['closeDialog']),

    /**
     * Hides the dialog and executes the action callback function.
     */
    closeAndAgree () {
      this.closeDialog('alertDialog')
      if (this.action) this.action()
    }
  }
}
</script>

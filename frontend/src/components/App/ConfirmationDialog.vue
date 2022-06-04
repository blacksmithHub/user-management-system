<template>
  <v-dialog
    :value="confirmationDialog"
    persistent
    max-width="500"
    scrollable
  >
    <v-card>
      <v-card-title
        class="title justify-center pt-10"
      >
        {{ title }}
      </v-card-title>

      <v-card-text class="text-center">
        <p
          v-for="(body, index) in content"
          :key="index"
        >
          {{ body }}
        </p>
      </v-card-text>

      <v-card-actions>
        <v-container>
          <v-row>
            <v-col
              cols="6"
              class="text-center"
            >
              <v-btn
                rounded
                block
                @click="closeAndAgree()"
              >
                {{ actionLabel }}
              </v-btn>
            </v-col>

            <v-col
              cols="6"
              class="text-center"
            >
              <v-btn
                rounded
                block
                @click="closeAndDisagree()"
              >
                {{ cancelLabel }}
              </v-btn>
            </v-col>
          </v-row>
        </v-container>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
import { mapActions, mapState } from 'vuex'

export default {
  name: 'AppConfirmationDialog',
  computed: {
    ...mapState('dialog', [
      'confirmationDialog',
      'title',
      'body',
      'action',
      'actionLabel',
      'cancel',
      'cancelLabel',
      'color'
    ]),

    content () {
      return this.body.split('\n')
    }
  },
  methods: {
    ...mapActions('dialog', ['closeDialog']),

    /**
     * Hides the dialog and executes the action callback function.
     *
     */
    closeAndAgree () {
      this.closeDialog('confirmationDialog')
      if (this.action) this.action()
    },

    /**
     * Hides the dialog and executes the cancel callback function.
     *
     */
    closeAndDisagree () {
      this.closeDialog('confirmationDialog')
      if (this.cancel) this.cancel()
    }
  }
}
</script>

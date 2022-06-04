<template>
  <v-row>
    <v-col
      cols="12"
      md="2"
    >
      <v-btn @click="$emit('click:add')">
        <v-icon left>
          mdi-plus
        </v-icon>
        add new user
      </v-btn>
    </v-col>

    <v-col
      cols="12"
      md="3"
    >
      <v-btn
        :disabled="!selected.length"
        @click="deleteUsers"
      >
        <v-icon left>
          mdi-delete
        </v-icon>
        delete selected user
      </v-btn>
    </v-col>
  </v-row>
</template>

<script>
import { mapActions } from 'vuex'

export default {
  props: {
    selected: {
      type: Array,
      default: Array
    }
  },
  methods: {
    ...mapActions('user', ['delete']),
    ...mapActions('dialog', ['openConfirmationDialog']),
    ...mapActions('snackbar', ['showSnackbar']),

    deleteUsers () {
      const params = this.selected.slice().map((item) => item.id)

      this.openConfirmationDialog({
        title: 'Delete all selected users',
        body: 'Are you sure to continue?',
        actionLabel: 'Delete',
        cancelLabel: 'Cancel',
        action: () => {
          this.delete({ ids: params })
          this.$emit('update:selected', [])
          this.showSnackbar({ message: 'Deleted successfully' })
        }
      })
    }
  }
}
</script>

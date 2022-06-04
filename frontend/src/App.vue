<template>
  <v-app>
    <router-view />
    <vue-progress-bar />
    <AlertDialog />
    <ConfirmationDialog />
    <Snackbar />
  </v-app>
</template>

<script>
import AlertDialog from '@/components/App/AlertDialog'
import ConfirmationDialog from '@/components/App/ConfirmationDialog'
import Snackbar from '@/components/App/Snackbar'

export default {
  name: 'App',
  components: {
    AlertDialog,
    ConfirmationDialog,
    Snackbar
  },
  mounted () {
    // [App.vue specific] When App.vue is finish loading finish the progress bar
    this.$Progress.finish()
  },
  created () {
    // [App.vue specific] When App.vue is first loading start the progress bar
    this.$Progress.start()
    // hook the progress bar to start before we move router-view
    this.$router.beforeEach((to, from, next) => {
      // start the progress bar
      this.$Progress.start()
      // continue to next page
      next()
    })
    // hook the progress bar to finish after we've finished moving router-view
    this.$router.afterEach(() => this.$Progress.finish())
  }
}
</script>

<style>
html {
  overflow-y: auto;
}
</style>

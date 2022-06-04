<template>
  <div>
    <v-app-bar
      dense
      dark
    >
      <v-toolbar-title>User Management System</v-toolbar-title>

      <v-spacer />

      <v-btn @click="logout">
        <v-icon left>
          mdi-logout
        </v-icon>
        logout
      </v-btn>
    </v-app-bar>
  </div>
</template>

<script>
import AuthService from '@/services/auth'
import httpException from '@/mixins/http-exception'
import Auth from '@/api/auth'

export default {
  mixins: [httpException],
  methods: {
    /**
     * Perform logout and flush storage
     */
    logout () {
      Auth.logout()
        .then(() => {
          AuthService.flush()
          this.$router.push({ name: 'Login' })
        })
        .catch(({ response }) => this.handle(response))
    }
  }
}
</script>

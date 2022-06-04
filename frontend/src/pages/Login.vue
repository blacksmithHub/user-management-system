<template>
  <v-app>
    <v-main class="grey lighten-4">
      <v-row
        class="grey lighten-4 fill-height"
        no-gutters
        justify="center"
        align="center"
      >
        <v-col
          cols="12"
          align-self="center"
        >
          <v-container
            fluid
            class="fill-height"
          >
            <v-row
              justify="center"
              align="center"
              no-gutters
            >
              <v-col
                cols="12"
                md="4"
                class="my-5"
              >
                <v-form @submit.prevent="submit">
                  <v-card :disabled="loading">
                    <v-card-title class="justify-center">
                      Login
                    </v-card-title>

                    <v-card-text class="py-0">
                      <LoginForm
                        ref="loginForm"
                        :api-errors="apiErrors"
                      />
                    </v-card-text>

                    <v-card-actions>
                      <v-container class="text-center pt-0">
                        <v-row
                          no-gutters
                          justify="center"
                          align="center"
                        >
                          <v-col
                            cols="12"
                            align-self="center"
                          >
                            <v-btn
                              block
                              rounded
                              type="submit"
                              :loading="loading"
                            >
                              Login

                              <v-icon right>
                                mdi-chevron-right
                              </v-icon>
                            </v-btn>
                          </v-col>
                        </v-row>
                      </v-container>
                    </v-card-actions>
                  </v-card>
                </v-form>
              </v-col>
            </v-row>
          </v-container>
        </v-col>
      </v-row>
    </v-main>

    <Footer />
  </v-app>
</template>

<script>
import Footer from '@/components/App/Footer'
import LoginForm from '@/components/Login/LoginForm'

import httpException from '@/mixins/http-exception'
import AuthService from '@/services/auth'

import Auth from '@/api/auth'

export default {
  components: {
    Footer,
    LoginForm
  },
  mixins: [httpException],
  data () {
    return {
      loading: false,
      apiErrors: {}
    }
  },
  methods: {
    /**
     * Submit event trigger
     */
    submit () {
      this.$refs.loginForm.$v.$touch()

      if (!this.$refs.loginForm.$v.$invalid) {
        this.loading = true

        Auth.login(this.$refs.loginForm.form)
          .then(({ data }) => {
            AuthService.setAuth(data)
            this.$router.push({ name: 'Home' })
          })
          .catch(({ response }) => {
            this.loading = false

            switch (response.status) {
              case 422:
                this.apiErrors = response.data.errors
                break

              default:
                this.handle(response)
                break
            }
          })
      }
    }
  }
}
</script>

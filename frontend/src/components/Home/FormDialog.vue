<template>
  <v-dialog
    v-model="dialog"
    width="500"
    persistent
  >
    <v-form
      :disabled="loading"
      @submit.prevent="submit"
    >
      <v-card>
        <v-card-title class="text-h5 grey lighten-2">
          {{ header }}
        </v-card-title>

        <v-card-text>
          <v-container>
            <v-row>
              <v-col
                cols="12"
                md="6"
              >
                <v-text-field
                  v-model="form.profile.first_name"
                  outlined
                  dense
                  hide-details="auto"
                  :error-messages="formErrors.first_name"
                  label="First Name"
                  @blur="$v.form.profile.first_name.$touch()"
                />
              </v-col>

              <v-col
                cols="12"
                md="6"
              >
                <v-text-field
                  v-model="form.profile.last_name"
                  outlined
                  dense
                  hide-details="auto"
                  :error-messages="formErrors.last_name"
                  label="Last Name"
                  @blur="$v.form.profile.last_name.$touch()"
                />
              </v-col>

              <v-col cols="12">
                <v-textarea
                  v-model="form.profile.address"
                  outlined
                  dense
                  hide-details="auto"
                  :error-messages="formErrors.address"
                  label="Address"
                  rows="1"
                  auto-grow
                  @blur="$v.form.profile.address.$touch()"
                />
              </v-col>

              <v-col
                cols="12"
                md="6"
              >
                <v-text-field
                  v-model="form.profile.postcode"
                  outlined
                  dense
                  hide-details="auto"
                  :error-messages="formErrors.postcode"
                  label="Postcode"
                  @blur="$v.form.profile.postcode.$touch()"
                />
              </v-col>

              <v-col
                cols="12"
                md="6"
              >
                <v-text-field
                  v-model="form.profile.phone_number"
                  outlined
                  dense
                  hide-details="auto"
                  :error-messages="formErrors.phone_number"
                  label="Phone Number"
                  @blur="$v.form.profile.phone_number.$touch()"
                />
              </v-col>

              <v-col
                cols="12"
                md="6"
              >
                <v-text-field
                  v-model="form.email"
                  outlined
                  dense
                  hide-details="auto"
                  :error-messages="formErrors.email"
                  label="Email"
                  @blur="$v.form.email.$touch()"
                />
              </v-col>

              <v-col
                cols="12"
                md="6"
              >
                <v-text-field
                  v-model="form.username"
                  outlined
                  dense
                  hide-details="auto"
                  :error-messages="formErrors.username"
                  label="Username"
                  @blur="$v.form.username.$touch()"
                />
              </v-col>

              <v-col cols="12">
                <v-text-field
                  v-model="form.password"
                  outlined
                  dense
                  hide-details="auto"
                  :error-messages="formErrors.password"
                  label="Password"
                  :type="showPassword ? 'text' : 'password'"
                  :append-icon="showPassword ? 'mdi-eye-off-outline' : 'mdi-eye-outline'"
                  @blur="$v.form.password.$touch()"
                  @click:append="showPassword = !showPassword"
                />
              </v-col>

              <v-col cols="12">
                <v-text-field
                  v-model="form.password_confirmation"
                  outlined
                  dense
                  hide-details="auto"
                  :error-messages="formErrors.password_confirmation"
                  label="Confirm Password"
                  :type="showConfirmPassword ? 'text' : 'password'"
                  :append-icon="showConfirmPassword ? 'mdi-eye-off-outline' : 'mdi-eye-outline'"
                  @blur="$v.form.password_confirmation.$touch()"
                  @click:append="showConfirmPassword = !showConfirmPassword"
                />
              </v-col>
            </v-row>
          </v-container>
        </v-card-text>

        <v-divider />

        <v-card-actions class="justify-end">
          <v-btn
            type="submit"
            :loading="loading"
          >
            save
          </v-btn>

          <v-btn @click="close">
            cancel
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-form>
  </v-dialog>
</template>

<script>
import { mapActions } from 'vuex'

import required from 'vuelidate/lib/validators/required'
import requiredIf from 'vuelidate/lib/validators/requiredIf'
import email from 'vuelidate/lib/validators/email'
import sameAs from 'vuelidate/lib/validators/sameAs'

import User from '@/api/user'

export default {
  props: {
    selected: {
      type: Object,
      default: Object
    }
  },
  data () {
    return {
      loading: false,
      showPassword: false,
      showConfirmPassword: false,
      dialog: false,
      isEditMode: false,
      form: {
        profile: {
          first_name: null,
          last_name: null,
          address: null,
          postcode: null,
          phone_number: null
        },
        email: null,
        username: null,
        password: null,
        password_confirmation: null
      },
      apiErrors: {}
    }
  },
  computed: {
    header () {
      return this.isEditMode ? 'Edit User' : 'Add New User'
    },

    /**
     * Error messages for form fields.
     */
    formErrors () {
      const errors = {
        first_name: this.apiErrors.first_name || [],
        last_name: this.apiErrors.last_name || [],
        address: this.apiErrors.address || [],
        postcode: this.apiErrors.postcode || [],
        phone_number: this.apiErrors.phone_number || [],
        email: this.apiErrors.email || [],
        username: this.apiErrors.username || [],
        password: this.apiErrors.password || [],
        password_confirmation: this.apiErrors.password_confirmation || []
      }

      if (this.$v.form.profile.first_name.$dirty) {
        this.$v.form.profile.first_name.required || errors.first_name.push('Required')
      }

      if (this.$v.form.profile.last_name.$dirty) {
        this.$v.form.profile.last_name.required || errors.last_name.push('Required')
      }

      if (this.$v.form.profile.address.$dirty) {
        this.$v.form.profile.address.required || errors.address.push('Required')
      }

      if (this.$v.form.profile.postcode.$dirty) {
        this.$v.form.profile.postcode.required || errors.postcode.push('Required')
      }

      if (this.$v.form.profile.phone_number.$dirty) {
        this.$v.form.profile.phone_number.required || errors.phone_number.push('Required')
      }

      if (this.$v.form.email.$dirty) {
        this.$v.form.email.required || errors.email.push('Required')
      }

      if (this.$v.form.username.$dirty) {
        this.$v.form.username.required || errors.username.push('Required')
      }

      if (this.$v.form.password.$dirty) {
        this.$v.form.password.required || errors.password.push('Required')
      }

      if (this.$v.form.password_confirmation.$dirty) {
        this.$v.form.password_confirmation.required || errors.password_confirmation.push('Required')
        this.$v.form.password_confirmation.sameAsPassword || errors.password_confirmation.push('Password is not match')
      }

      return errors
    }
  },
  watch: {
    'form.profile.first_name' () {
      delete this.apiErrors.first_name
    },
    'form.profile.last_name' () {
      delete this.apiErrors.last_name
    },
    'form.profile.address' () {
      delete this.apiErrors.address
    },
    'form.profile.postcode' () {
      delete this.apiErrors.postcode
    },
    'form.profile.phone_number' () {
      delete this.apiErrors.phone_number
    },
    'form.email' () {
      delete this.apiErrors.email
    },
    'form.username' () {
      delete this.apiErrors.username
    },
    'form.password' () {
      delete this.apiErrors.password
    },
    'form.password_confirmation' () {
      delete this.apiErrors.password_confirmation
    }
  },
  methods: {
    ...mapActions('snackbar', ['showSnackbar']),

    submit () {
      this.$v.$touch()

      if (!this.$v.$invalid) {
        this.loading = true

        const params = {}

        if (this.form.profile.first_name && this.form.profile.first_name !== this.selected.profile.first_name) params.first_name = this.form.profile.first_name

        if (this.form.profile.last_name && this.form.profile.last_name !== this.selected.profile.last_name) params.last_name = this.form.profile.last_name

        if (this.form.profile.address && this.form.profile.address !== this.selected.profile.address) params.address = this.form.profile.address

        if (this.form.profile.postcode && this.form.profile.postcode !== this.selected.profile.postcode) params.postcode = this.form.profile.postcode

        if (this.form.profile.phone_number && this.form.profile.phone_number !== this.selected.profile.phone_number) params.phone_number = this.form.profile.phone_number

        if (this.form.email && this.form.email !== this.selected.email) params.email = this.form.email

        if (this.form.username && this.form.username !== this.selected.username) params.username = this.form.username

        if (this.form.password) params.password = this.form.password

        if (this.form.password_confirmation) params.password_confirmation = this.form.password_confirmation

        const api = this.isEditMode ? User.update(this.form.id, params) : User.store(params)

        api.then(() => {
          this.$emit('click:paginate')
          this.close()
          this.showSnackbar({ message: 'Saved successfully' })
        })
          .catch(({ response }) => {
            switch (response.status) {
              case 422:
                this.apiErrors = response.data.errors
                break

              default:
                this.handle(response)
                break
            }
          })
          .finally(() => {
            this.loading = false
          })
      }
    },
    close () {
      this.$v.$reset()

      this.loading = false
      this.showConfirmPassword = false
      this.showPassword = false
      this.isEditMode = false
      this.form = {
        profile: {
          first_name: null,
          last_name: null,
          address: null,
          postcode: null,
          phone_number: null
        },
        email: null,
        username: null,
        password: null,
        password_confirmation: null
      }
      this.apiErrors = {}
      this.dialog = false
    }
  },
  validations: {
    form: {
      profile: {
        first_name: { required },
        last_name: { required },
        address: { required },
        postcode: { required },
        phone_number: { required }
      },
      email: { required, email },
      username: { required },
      password: {
        required: requiredIf(function () {
          return !this.isEditMode
        })
      },
      password_confirmation: {
        required: requiredIf(function () {
          return !this.isEditMode
        }),
        sameAsPassword: sameAs(function () {
          return this.form.password
        })
      }
    }
  }
}
</script>

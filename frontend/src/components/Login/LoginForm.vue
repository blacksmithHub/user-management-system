<template>
  <v-container>
    <v-row>
      <v-col cols="12">
        <v-text-field
          v-model="form.login"
          :error-messages="formErrors.login"
          label="Username or Email Address"
          outlined
          dense
          hide-details="auto"
          @blur="$v.form.login.$touch()"
        />
      </v-col>

      <v-col cols="12">
        <v-text-field
          v-model="form.password"
          :error-messages="formErrors.password"
          label="Password"
          :type="showPassword ? 'text' : 'password'"
          outlined
          dense
          hide-details="auto"
          :append-icon="showPassword ? 'mdi-eye-off-outline' : 'mdi-eye-outline'"
          @blur="$v.form.password.$touch()"
          @click:append="showPassword = !showPassword"
        />
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import { required } from 'vuelidate/lib/validators'

export default {
  props: {
    apiErrors: {
      type: Object,
      default: Object
    }
  },
  data () {
    return {
      showPassword: false,
      form: {
        login: null,
        password: null
      }
    }
  },
  computed: {
    /**
     * Error messages for form fields.
     */
    formErrors () {
      const errors = {
        login: this.apiErrors.login || [],
        password: this.apiErrors.password || []
      }

      if (this.$v.form.login.$dirty) {
        this.$v.form.login.required || errors.login.push('Required')
      }

      if (this.$v.form.password.$dirty) {
        this.$v.form.password.required || errors.password.push('Required')
      }

      return errors
    }
  },
  watch: {
    'form.login' () {
      if (this.form.login) this.form.login = this.form.login.trim()

      delete this.apiErrors.login
    },
    'form.password' () {
      delete this.apiErrors.password
    }
  },
  methods: {
    /**
     * Reset form
     */
    reset () {
      this.$v.$reset()

      this.form = {
        login: null,
        password: null
      }
    }
  },
  validations: {
    form: {
      login: { required },
      password: { required }
    }
  }
}
</script>

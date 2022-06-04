<template>
  <v-data-table
    v-model="model"
    :headers="headers"
    :items="list"
    item-key="id"
    :show-select="isAdmin"
    hide-default-footer
  >
    <template v-slot:item.profile.first_name="{item}">
      {{ item.profile.first_name }} {{ item.profile.last_name }}
    </template>

    <template v-slot:item.profile.postcode="{item}">
      <p class="ma-0">
        {{ item.profile.address }}
      </p>
      <p class="ma-0">
        <span class="font-weight-bold">Postcode:</span> {{ item.profile.postcode }}
      </p>
    </template>

    <template v-slot:item.id="{item}">
      <v-btn
        v-if="isAdmin"
        icon
        @click="$emit('click:edit', item)"
      >
        <v-icon>mdi-pencil</v-icon>
      </v-btn>
    </template>
  </v-data-table>
</template>

<script>
import { mapState, mapGetters } from 'vuex'

import Auth from '@/services/auth'

export default {
  props: {
    selected: {
      type: Array,
      default: Array
    }
  },
  data () {
    return {
      model: [],
      headers: [
        {
          text: 'Full Name',
          value: 'profile.first_name'
        },
        {
          text: 'Username',
          value: 'username'
        },
        {
          text: 'Email',
          value: 'email'
        },
        {
          text: 'Phone Number',
          value: 'profile.phone_number'
        },
        {
          text: 'Address',
          value: 'profile.postcode'
        },
        {
          text: '',
          sortable: false,
          value: 'id'
        }
      ],
      list: []
    }
  },
  computed: {
    ...mapState('user', { items: 'data' }),
    ...mapGetters('user', ['hasData']),

    isAdmin () {
      return !!Auth.getUser().isAdmin
    }
  },
  watch: {
    items () {
      this.list = this.hasData ? this.items.data : []
    },
    selected () {
      this.model = this.selected
    },
    model () {
      this.$emit('update:selected', this.model)
    }
  },
  created () {
    this.list = this.hasData ? this.items.data : []
    this.model = this.selected
  }
}
</script>

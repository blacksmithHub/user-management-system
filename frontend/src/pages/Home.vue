<template>
  <v-container>
    <v-card
      v-if="loading"
      flat
    >
      <v-skeleton-loader
        class="mx-auto"
        type="table-heading, table-thead, table-tbody"
      />
    </v-card>

    <v-card
      v-else
      flat
    >
      <v-card-title v-if="isAdmin">
        <Header
          :selected.sync="selected"
          @click:paginate="paginate"
          @click:add="$refs.formDialog.dialog = true"
        />
      </v-card-title>

      <v-card-text>
        <Table
          :selected.sync="selected"
          @click:edit="editUser"
        />
      </v-card-text>

      <v-card-actions class="justify-center">
        <Pagination @click:paginate="paginate" />
      </v-card-actions>
    </v-card>

    <FormDialog
      v-if="isAdmin"
      ref="formDialog"
      :selected="selectedUser"
      @click:paginate="paginate"
    />
  </v-container>
</template>

<script>
import { mapState, mapActions } from 'vuex'

import Header from '@/components/Home/Header'
import Table from '@/components/Home/Table'
import Pagination from '@/components/Home/Pagination'
import FormDialog from '@/components/Home/FormDialog'

import Auth from '@/services/auth'

export default {
  components: {
    Header,
    Table,
    Pagination,
    FormDialog
  },
  data () {
    return {
      selected: [],
      selectedUser: {}
    }
  },
  computed: {
    ...mapState('user', ['loading']),

    isAdmin () {
      return !!Auth.getUser().isAdmin
    }
  },
  created () {
    this.paginate()
  },
  methods: {
    ...mapActions('user', ['fetch']),

    paginate (page = 1) {
      this.fetch({ page: page, per_page: 10 })
    },

    editUser (item) {
      const data = JSON.parse(JSON.stringify(item))

      this.selectedUser = data
      this.$refs.formDialog.dialog = true
      this.$refs.formDialog.form = data
      this.$refs.formDialog.isEditMode = true
    }
  }
}
</script>

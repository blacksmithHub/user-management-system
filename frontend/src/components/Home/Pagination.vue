<template>
  <v-pagination
    v-model="page"
    :length="pageLength"
    :total-visible="5"
    color="black"
    @input="$emit('click:paginate', page)"
  />
</template>

<script>
import { mapState, mapGetters } from 'vuex'

export default {
  data () {
    return {
      page: 1,
      pageLength: 0
    }
  },
  computed: {
    ...mapState('user', { items: 'data' }),
    ...mapGetters('user', ['hasData'])
  },
  watch: {
    items () {
      this.init()
    }
  },
  created () {
    this.init()
  },
  methods: {
    init () {
      this.pageLength = this.hasData ? this.items.last_page : 0
      this.page = this.hasData ? this.items.current_page : 1
    }
  }
}
</script>

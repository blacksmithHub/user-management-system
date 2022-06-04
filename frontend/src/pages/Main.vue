<template>
  <v-app class="grey lighten-4">
    <Header />
    <v-main class="my-3">
      <router-view />
    </v-main>
    <Footer />
  </v-app>
</template>

<script>
import Footer from '@/components/App/Footer'
import Header from '@/components/App/Header'

export default {
  components: {
    Footer,
    Header
  }
}
</script>

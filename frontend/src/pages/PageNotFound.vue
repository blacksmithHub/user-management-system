<template>
  <v-app>
    <v-main>
      <v-row
        class="fill-height"
        align="center"
        justify="center"
      >
        <v-col
          cols="4"
          class="text-center"
        >
          <div class="body-1 my-4 text-center">
            <p>
              The page you are looking for is not found
              <br>
              Please direct to <a @click="goTo('Home')">home page</a>.
            </p>
          </div>
        </v-col>
      </v-row>
    </v-main>
  </v-app>
</template>

<script>
export default {
  methods: {
    goTo (link) {
      this.$router.push({ name: link })
    }
  }
}
</script>

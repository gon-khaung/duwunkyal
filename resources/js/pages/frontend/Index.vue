<template>
    <div>
        <NavBar />
        <router-view></router-view>
        <Footer />
    </div>
</template>
<script>
export default {
  methods: {
    async fetchContact() {
      try {
        const res = await axios.get('/sitecontacts');
        this.$store.commit('setContact', res.data.data[0]);
      } catch (error) {
        console.log(error);
      }
    },
  },
  mounted() {
    this.fetchContact();
  },
};
</script>

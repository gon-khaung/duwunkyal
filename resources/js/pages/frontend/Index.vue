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
    setLocalstorage(name, data) {
      localStorage.setItem(name, JSON.stringify(data));
    },
  },
  mounted() {
    this.fetchContact();
    if (!localStorage.getItem('cartProducts')) {
      this.setLocalstorage('cartProducts', []);
    }
  },
};
</script>

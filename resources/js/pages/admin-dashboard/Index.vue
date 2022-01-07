<template>
  <div>
    <SideBar />
    <!-- Main content -->
    <div class="main-content" id="panel">
      <DashboardNav />
      <router-view class="m-3"></router-view>
    </div>
  </div>
</template>
<script>
import SideBar from './components/SideBar.vue';
import DashboardNav from './components/DashboardNav.vue';

export default {
  components: { SideBar, DashboardNav },
  mounted() {
    // if (!this.$auth.check()) {
    //   this.$router.push('/admin/login');
    // } else if (!this.$auth.check('admin')) {
    //   this.$router.push('/');
    // }
  },
};
</script>

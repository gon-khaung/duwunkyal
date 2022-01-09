<template>
    <!-- Sidenav -->
    <nav
        class="
            sidenav
            navbar navbar-vertical
            fixed-left
            navbar-expand-xs navbar-light
            bg-white
        "
        id="sidenav-main"
    >
        <div class="scrollbar-inner">
            <!-- Brand -->
            <div class="sidenav-header align-items-center">
                <a class="navbar-brand" href="javascript:void(0)">
                    <img
                        src="/build/assets/img/brand/blue.png"
                        class="navbar-brand-img"
                        alt="..."
                    />
                </a>
            </div>
            <div class="navbar-inner">
                <!-- Collapse -->
                <div
                    class="collapse navbar-collapse"
                    id="sidenav-collapse-main"
                >
                    <!-- Nav items -->
                    <ul class="navbar-nav">
                        <li
                            class="nav-item"
                            data-action="sidenav-pin"
                            data-target="#sidenav-main"
                            :class="isMobile ? 'sidenav-toggler' : ''"
                        >
                            <router-link
                                to="/admin/products"
                                :class="
                                    linkIsActive('/admin/products')
                                        ? 'active'
                                        : ''
                                "
                                class="nav-link"
                            >
                                <i class="ni ni-settings"></i>
                                <b class="nav-link-text">Products</b>
                            </router-link>
                        </li>
                        <li
                            class="nav-item"
                            data-action="sidenav-pin"
                            data-target="#sidenav-main"
                            :class="isMobile ? 'sidenav-toggler' : ''"
                        >
                            <router-link
                                to="/admin/users-management"
                                :class="
                                    linkIsActive('/admin/users-management')
                                        ? 'active'
                                        : ''
                                "
                                class="nav-link"
                            >
                                <i class="ni ni-single-02"></i>
                                <b class="nav-link-text">User Management</b>
                            </router-link>
                        </li>
                        <li
                            class="nav-item"
                            data-action="sidenav-pin"
                            data-target="#sidenav-main"
                            :class="isMobile ? 'sidenav-toggler' : ''"
                        >
                            <router-link
                                to="/admin/orders"
                                :class="
                                    linkIsActive('/admin/orders')
                                        ? 'active'
                                        : ''
                                "
                                class="nav-link"
                            >
                                <i class="ni ni-settings-gear-65"></i>
                                <b class="nav-link-text">Orders</b>
                            </router-link>
                        </li>
                        <li
                            class="nav-item"
                            data-action="sidenav-pin"
                            data-target="#sidenav-main"
                            :class="isMobile ? 'sidenav-toggler' : ''"
                        >
                            <router-link
                                to="/admin/categories"
                                :class="
                                    linkIsActive('/admin/categories')
                                        ? 'active'
                                        : ''
                                "
                                class="nav-link"
                            >
                                <i class="ni ni-settings"></i>
                                <b class="nav-link-text">Category</b>
                            </router-link>
                        </li>

                        <li
                            class="nav-item"
                            data-action="sidenav-pin"
                            data-target="#sidenav-main"
                            :class="isMobile ? 'sidenav-toggler' : ''"
                        >
                            <router-link
                                to="/admin/sitecontacts"
                                :class="
                                    linkIsActive('/admin/sitecontacts')
                                        ? 'active'
                                        : ''
                                "
                                class="nav-link"
                            >
                                <i class="ni ni-paper-diploma"></i>
                                <b class="nav-link-text">Site Contacts</b>
                            </router-link>
                        </li>
                    </ul>
                    <!-- Divider -->
                    <hr class="my-3" />
                    <!-- Navigation -->
                    <ul class="navbar-nav mb-md-3">
                        <li class="nav-item">
                            <div class="nav-link" @click="logout()">
                                <i
                                    class="
                                        ni ni-lock-circle-open
                                        text-danger
                                        mr-3
                                    "
                                ></i>
                                <b class="nav-link-text text-danger">Log Out</b>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</template>
<script>
import { Toast, Dialog } from 'vant';

export default {
  data() {
    return {
      isMobile: false,
      isDeposits: false,
      isWithdraws: false,
      depositsInterval: null,
      withdrawsInterval: null,
    };
  },
  methods: {
    closeNavCollapse() {
      $('#sidenav-main').collapse('hide');
    },
    /* example link = '/settings' */
    linkIsActive(link) {
      const paths = Array.isArray(link) ? link : [link];
      const res = paths.some(
        (path) => this.$route.path.indexOf(path) === 0,
      );
      if (res) {
        return true;
      }
      return false;
    },
    logout() {
      Dialog.confirm({
        title:
                    this.$store.state.language === 'en'
                      ? 'Are you sure to log out?'
                      : 'ထွက်မှာ သေချာပါသလား?',
        cancelButtonText:
                    this.$store.state.language === 'en'
                      ? 'Cancel'
                      : 'မထွက်တော့ပါ',
        confirmButtonText:
                    this.$store.state.language === 'en' ? 'Sure' : 'သေချာပြီ',
      })
        .then(() => {
          this.$auth.logout({
            redirect: '/',
          });
          Toast.success(
            this.$store.state.language === 'en'
              ? 'Logged out!'
              : 'ထွက်ပြီးပြီ',
          );
        })
        .catch(() => {});
    },
    async checkDeposits() {
      try {
        const res = await axios.get('/check/deposits');
        this.isDeposits = res.data.isDeposits;
      } catch (error) {
        console.log(error);
      }
    },
    async checkWithdraws() {
      try {
        const res = await axios.get('/check/withdraws');
        this.isWithdraws = res.data.isWithdraws;
      } catch (error) {
        console.log(error);
      }
    },
  },
  mounted() {
    this.checkDeposits();
    this.checkWithdraws();
    this.depositsInterval = setInterval(() => this.checkDeposits(), 600000);
    this.withdrawsInterval = setInterval(
      () => this.checkWithdraws(),
      600000,
    );
    if (window.innerWidth < 768) {
      this.isMobile = true;
    }
  },
  destroyed() {
    clearInterval(this.depositsInterval);
    clearInterval(this.withdrawsInterval);
  },
};
</script>
<style scoped>
.nav-link {
    cursor: pointer;
}
</style>

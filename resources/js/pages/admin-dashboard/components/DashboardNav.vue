<template>
  <!-- Topnav -->
  <nav
    class="navbar navbar-top navbar-expand navbar-dark bg-default border-bottom"
  >
    <div class="container-fluid">
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Navbar links -->
        <ul class="navbar-nav align-items-center ml-md-auto">
          <li class="nav-item d-xl-none">
            <!-- Sidenav toggler -->
            <div
              class="pr-3 sidenav-toggler sidenav-toggler-dark"
              data-action="sidenav-pin"
              data-target="#sidenav-main"
            >
              <div class="sidenav-toggler-inner">
                <i class="sidenav-toggler-line"></i>
                <i class="sidenav-toggler-line"></i>
                <i class="sidenav-toggler-line"></i>
              </div>
            </div>
          </li>
        </ul>
        <ul class="navbar-nav align-items-center ml-auto ml-md-0">
          <li class="nav-item dropdown">
            <div
              class="nav-link d-flex flex-column p-2"
              href="#"
              id="navbar-default_dropdown_1"
              role="button"
              data-toggle="dropdown"
              aria-haspopup="true"
              aria-expanded="false"
            >
              <img
                class="rounded-circle mb-2"
                style="
                  height: 30px;
                  width: 30px;
                  border-radius: 50%;
                  margin-right: auto;
                "
                :src="imageLink"
                alt=""
              />
              <div>
                {{ $auth.user().name ? $auth.user().name : $auth.user().email }}
              </div>
            </div>
            <div class="dropdown-menu dropdown-menu-right">
              <router-link to="/admin/products" class="dropdown-item">
                <i class="ni ni-settings"></i>Products
              </router-link>
              <router-link to="/admin/users-management" class="dropdown-item">
                <i class="ni ni-single-02"></i>Users
              </router-link>
              <router-link to="/admin/orders" class="dropdown-item">
                <i class="ni ni-settings-gear-65"></i>Orders
              </router-link>
              <router-link to="/admin/categoies" class="dropdown-item">
                <i class="ni ni-settings"></i>Categories
              </router-link>
              <router-link to="/admin/sitecontacts" class="dropdown-item">
                <i class="ni ni-credit-card"></i>Site Contacts
              </router-link>
              <router-link to="/admin/dynamic-names" class="dropdown-item">
                <i class="ni ni-paper-diploma"></i>Dynamic Names
              </router-link>
              <router-link to="/admin/contacts" class="dropdown-item">
                <i class="ni ni-tv-2"></i>Contacts
              </router-link>

              <div class="dropdown-divider"></div>
              <div class="dropdown-item text-danger" @click="logout">
                <i class="ni ni-lock-circle-open"></i>Log Out
              </div>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>
<script>
import { Toast, Dialog } from 'vant';

export default {
  data() {
    return {
      imageLink: this.$auth.user().email
        ? `https://ui-avatars.com/api/?name=${
          this.$auth.user().email
        }&background=0D8ABC&color=fff`
        : '',
    };
  },
  methods: {
    setLangLocalstorage(language) {
      localStorage.setItem('language', language);
      this.$store.commit('setLanguage', language);
    },
    logout() {
      Dialog.confirm({
        title:
          this.$store.state.language === 'en'
            ? 'Are you sure to log out?'
            : 'ထွက်မှာ သေချာပါသလား?',
        cancelButtonText:
          this.$store.state.language === 'en' ? 'Cancel' : 'မထွက်တော့ပါ',
        confirmButtonText:
          this.$store.state.language === 'en' ? 'Sure' : 'သေချာပြီ',
      })
        .then(() => {
          this.$auth.logout({
            redirect: '/',
          });
          Toast.success(
            this.$store.state.language === 'en' ? 'Logged out!' : 'ထွက်ပြီးပြီ',
          );
        })
        .catch(() => {});
    },
  },
};
</script>
<style scoped>
.nav-item,
.dropdown-item {
  cursor: pointer;
}
</style>

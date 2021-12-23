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
                                to="/admin/twod-threed"
                                :class="
                                    linkIsActive('/admin/twod-threed')
                                        ? 'active'
                                        : ''
                                "
                                class="nav-link"
                            >
                                <i class="ni ni-atom"></i>
                                <b class="nav-link-text">{{
                                    $store.state.language === "en"
                                        ? "2D 3D"
                                        : "နှစ်လုံး သုံးလုံး"
                                }}</b>
                            </router-link>
                        </li>
                        <li
                            class="nav-item"
                            data-action="sidenav-pin"
                            data-target="#sidenav-main"
                            :class="isMobile ? 'sidenav-toggler' : ''"
                        >
                            <router-link
                                to="/admin/betslip-history"
                                :class="
                                    linkIsActive('/admin/betslip-history')
                                        ? 'active'
                                        : ''
                                "
                                class="nav-link"
                            >
                                <i class="ni ni-single-copy-04"></i>
                                <b class="nav-link-text">{{
                                    $store.state.language === "en"
                                        ? "Betslip History"
                                        : "ဘောက်ချာများ"
                                }}</b>
                            </router-link>
                        </li>
                        <li
                            class="nav-item"
                            data-action="sidenav-pin"
                            data-target="#sidenav-main"
                            :class="isMobile ? 'sidenav-toggler' : ''"
                        >
                            <router-link
                                to="/admin/withdraw"
                                :class="
                                    (linkIsActive('/admin/withdraw')
                                        ? 'active'
                                        : '',
                                    isWithdraws ? 'text-danger' : '')
                                "
                                class="nav-link"
                            >
                                <i class="ni ni-money-coins"></i>
                                <b class="nav-link-text">{{
                                    $store.state.language === "en"
                                        ? "Withdraw"
                                        : "ငွေထုတ်"
                                }}</b>
                            </router-link>
                        </li>
                        <li
                            class="nav-item"
                            data-action="sidenav-pin"
                            data-target="#sidenav-main"
                            :class="isMobile ? 'sidenav-toggler' : ''"
                        >
                            <router-link
                                to="/admin/deposit"
                                :class="
                                    (linkIsActive('/admin/deposit')
                                        ? 'active'
                                        : '',
                                    isDeposits ? 'text-danger' : '')
                                "
                                class="nav-link"
                            >
                                <i class="ni ni-credit-card"></i>
                                <b class="nav-link-text">{{
                                    $store.state.language === "en"
                                        ? "Deposit"
                                        : "ငွေသွင်း"
                                }}</b>
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
                                <b class="nav-link-text">{{
                                    $store.state.language === "en"
                                        ? "User Management"
                                        : "အသုံးပြုသူ ထိန်းချုပ်မှု"
                                }}</b>
                            </router-link>
                        </li>
                        <li
                            class="nav-item"
                            data-action="sidenav-pin"
                            data-target="#sidenav-main"
                            :class="isMobile ? 'sidenav-toggler' : ''"
                        >
                            <router-link
                                to="/admin/twod-management"
                                :class="
                                    linkIsActive('/admin/twod-management')
                                        ? 'active'
                                        : ''
                                "
                                class="nav-link"
                            >
                                <i class="ni ni-settings-gear-65"></i>
                                <b class="nav-link-text">{{
                                    $store.state.language === "en"
                                        ? "2D Management"
                                        : "နှစ်လုံး ထိန်းချုပ်မှု"
                                }}</b>
                            </router-link>
                        </li>
                        <li
                            class="nav-item"
                            data-action="sidenav-pin"
                            data-target="#sidenav-main"
                            :class="isMobile ? 'sidenav-toggler' : ''"
                        >
                            <router-link
                                to="/admin/threed-management"
                                :class="
                                    linkIsActive('/admin/threed-management')
                                        ? 'active'
                                        : ''
                                "
                                class="nav-link"
                            >
                                <i class="ni ni-settings"></i>
                                <b class="nav-link-text">{{
                                    $store.state.language === "en"
                                        ? "3D Management"
                                        : "သုံးလုံး ထိန်းချုပ်မှု"
                                }}</b>
                            </router-link>
                        </li>
                        <li
                            class="nav-item"
                            data-action="sidenav-pin"
                            data-target="#sidenav-main"
                            :class="isMobile ? 'sidenav-toggler' : ''"
                        >
                            <router-link
                                to="/admin/payment-accounts"
                                :class="
                                    linkIsActive('/admin/payment-accounts')
                                        ? 'active'
                                        : ''
                                "
                                class="nav-link"
                            >
                                <i class="ni ni-paper-diploma"></i>
                                <b class="nav-link-text">{{
                                    $store.state.language === "en"
                                        ? "Payment Accounts"
                                        : "ငွေပေးချေမှု အကောင့်များ"
                                }}</b>
                            </router-link>
                        </li>
                        <li
                            class="nav-item"
                            data-action="sidenav-pin"
                            data-target="#sidenav-main"
                            :class="isMobile ? 'sidenav-toggler' : ''"
                        >
                            <router-link
                                to="/admin/ledger"
                                :class="
                                    linkIsActive('/admin/ledger')
                                        ? 'active'
                                        : ''
                                "
                                class="nav-link"
                                @click="closeNavCollapse"
                            >
                                <i class="ni ni-tv-2"></i>
                                <b class="nav-link-text">{{
                                    $store.state.language === "en"
                                        ? "Ledger"
                                        : "လက်ဂျာ"
                                }}</b>
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
                                <b class="nav-link-text text-danger">{{
                                    $store.state.language === "en"
                                        ? "Log Out"
                                        : "ထွက်မည်"
                                }}</b>
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

<template>
    <!-- Topnav -->
    <nav
        class="
            navbar navbar-top navbar-expand navbar-dark
            bg-default
            border-bottom
        "
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
                            class="nav-link nav-link-icon mr-4"
                            role="button"
                            data-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false"
                        >
                            <b
                                class="nav-link-inner--text"
                                id="navbar-language"
                                >{{
                                    $store.state.language === "en"
                                        ? "Language"
                                        : "ဘာသာစကား"
                                }}</b
                            >
                        </div>

                        <div
                            class="dropdown-menu dropdown-menu-right"
                            aria-labelledby="navbar-language"
                        >
                            <a
                                class="dropdown-item"
                                @click="setLangLocalstorage('en')"
                                ><img
                                    src="/build/assets/img/icons/common/united-kingdom.png"
                                    alt=""
                                    class="mr-2"
                                    style="width: 20px; height: 20px"
                                />
                                {{
                                    $store.state.language === "en"
                                        ? "English"
                                        : "အဂ်လိပ်စာ"
                                }}</a
                            >
                            <div class="dropdown-divider"></div>
                            <a
                                class="dropdown-item"
                                @click="setLangLocalstorage('mm')"
                                ><img
                                    src="/build/assets/img/icons/common/myanmar.png"
                                    alt=""
                                    class="mr-2"
                                    style="width: 20px; height: 20px"
                                />{{
                                    $store.state.language === "en"
                                        ? "Myanmar (Burmese)"
                                        : "မြန်မာ (ဗမာစာ)"
                                }}</a
                            >
                        </div>
                    </li>
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
                                {{
                                    $auth.user().name
                                        ? $auth.user().name
                                        : $auth.user().email
                                }}
                            </div>
                        </div>
                        <div class="dropdown-menu dropdown-menu-right">
                            <router-link
                                to="/admin/twod-threed"
                                class="dropdown-item"
                            >
                                <i class="ni ni-atom"></i>
                                {{
                                    $store.state.language === "en"
                                        ? "Two-D Three-D"
                                        : "နှစ်လုံး သုံးလုံး"
                                }}
                            </router-link>
                            <router-link
                                to="/admin/betslip-history"
                                class="dropdown-item"
                            >
                                <i class="ni ni-single-copy-04"></i>
                                {{
                                    $store.state.language === "en"
                                        ? "Betslip History"
                                        : "ဘောက်ချာများ"
                                }}
                            </router-link>
                            <router-link
                                to="/admin/deposit"
                                class="dropdown-item"
                            >
                                <i class="ni ni-credit-card"></i>
                                {{
                                    $store.state.language === "en"
                                        ? "Deposit"
                                        : "ငွေသွင်း"
                                }}
                            </router-link>
                            <router-link
                                to="/admin/withdraw"
                                class="dropdown-item"
                            >
                                <i class="ni ni-money-coins"></i>
                                {{
                                    $store.state.language === "en"
                                        ? "Withdraw"
                                        : "ငွေထုတ်"
                                }}
                            </router-link>
                            <router-link
                                to="/admin/users-management"
                                class="dropdown-item"
                            >
                                <i class="ni ni-single-02"></i>
                                {{
                                    $store.state.language === "en"
                                        ? "User Management"
                                        : "အသုံးပြုသူ ထိန်းချုပ်မှု"
                                }}
                            </router-link>
                            <router-link
                                to="/admin/twod-management"
                                class="dropdown-item"
                            >
                                <i class="ni ni-settings-gear-65"></i>
                                {{
                                    $store.state.language === "en"
                                        ? "2d Management"
                                        : "နှစ်လုံး ထိန်းချုပ်မှု"
                                }}
                            </router-link>
                            <router-link
                                to="/admin/threed-management"
                                class="dropdown-item"
                            >
                                <i class="ni ni-settings"></i>
                                {{
                                    $store.state.language === "en"
                                        ? "3d Management"
                                        : "သုံးလုံး ထိန်းချုပ်မှု"
                                }}
                            </router-link>
                            <router-link
                                to="/admin/payment-accounts"
                                class="dropdown-item"
                            >
                                <i class="ni ni-paper-diploma"></i>
                                {{
                                    $store.state.language === "en"
                                        ? "Payment Accounts"
                                        : "ငွေပေးချေမှု အကောင့်များ"
                                }}
                            </router-link>
                            <router-link
                                to="/admin/ledger"
                                class="dropdown-item"
                            >
                                <i class="ni ni-tv-2"></i>
                                {{
                                    $store.state.language === "en"
                                        ? "Ledger"
                                        : "လက်ဂျာ"
                                }}
                            </router-link>

                            <div class="dropdown-divider"></div>
                            <div
                                class="dropdown-item text-danger"
                                @click="logout"
                            >
                                <i class="ni ni-lock-circle-open"></i>
                                {{
                                    $store.state.language === "en"
                                        ? "Log Out"
                                        : "ထွက်မည်"
                                }}
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
  },
};
</script>
<style scoped>
.nav-item,
.dropdown-item {
    cursor: pointer;
}
</style>

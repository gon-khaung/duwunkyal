<template>
    <div>
        <Sticky>
            <nav
                class="
                    navbar navbar-horizontal navbar-expand-lg navbar-dark
                    bg-default
                "
            >
                <div class="container-fluid">
                    <div class="navbar-brand">
                        <img src="/build/assets/img/brand/blue.png" alt="" />
                    </div>
                    <div class="navbar-brand" @click="$router.push('/')">
                        {{ $store.state.language === "en" ? "Home" : "မူလ" }}
                    </div>
                    <div class="navbar-brand" @click="redirectRoute('2d')">
                        {{ $store.state.language === "en" ? "2D" : "နှစ်လုံး" }}
                    </div>
                    <div class="navbar-brand" @click="redirectRoute('3d')">
                        {{ $store.state.language === "en" ? "3D" : "သုံးလုံး" }}
                    </div>

                    <button
                        class="navbar-toggler"
                        type="button"
                        data-toggle="collapse"
                        data-target="#navbar-default"
                        aria-controls="navbar-default"
                        aria-expanded="false"
                        aria-label="Toggle navigation"
                    >
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbar-default">
                        <div class="navbar-collapse-header">
                            <div class="row">
                                <div class="col-6 collapse-brand">
                                    <a href="javascript:void(0)">
                                        <img
                                            src="/build/assets/img/brand/blue.png"
                                        />
                                    </a>
                                </div>
                                <div class="col-6 collapse-close">
                                    <button
                                        type="button"
                                        class="navbar-toggler"
                                        data-toggle="collapse"
                                        data-target="#navbar-default"
                                        aria-controls="navbar-default"
                                        aria-expanded="false"
                                        aria-label="Toggle navigation"
                                    >
                                        <span></span>
                                        <span></span>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <ul class="navbar-nav ml-lg-auto">
                            <li class="nav-item dropdown d-flex">
                                <div
                                    class="nav-link nav-link-icon"
                                    :class="$auth.check() ? '' : 'my-auto'"
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
                            <li
                                class="nav-item dropdown d-flex"
                                :class="$auth.check() ? '' : 'my-auto'"
                            >
                                <div
                                    @click="
                                        $router.push('/faq'), closeNavCollapse()
                                    "
                                    class="nav-link nav-link-icon"
                                >
                                    <b class="nav-link-inner--text">{{
                                        $store.state.language === "en"
                                            ? "F.A.Q"
                                            : "မေးလေ့ရှိသော မေးခွန်းများ"
                                    }}</b>
                                </div>
                            </li>

                            <li class="nav-item" v-if="!$auth.check()">
                                <div class="nav-link nav-link-icon" href="#">
                                    <span class="nav-link-inner--text">
                                        <button
                                            class="btn btn-primary"
                                            @click="
                                                $router.push('/auth/login'),
                                                    closeNavCollapse()
                                            "
                                        >
                                            <i
                                                class="fas fa-sign-in-alt mr-1"
                                            ></i>
                                            {{
                                                $store.state.language === "en"
                                                    ? "Login"
                                                    : "ဝင်မည်"
                                            }}
                                        </button>
                                    </span>
                                </div>
                            </li>
                            <li class="nav-item" v-if="!$auth.check()">
                                <div class="nav-link nav-link-icon" href="#">
                                    <span class="nav-link-inner--text">
                                        <button
                                            class="btn btn-primary"
                                            @click="
                                                $router.push('/auth/register'),
                                                    closeNavCollapse()
                                            "
                                        >
                                            <i
                                                class="fas fa-user-plus mr-1"
                                            ></i>
                                            {{
                                                $store.state.language === "en"
                                                    ? "Register"
                                                    : "အကောင့်ဖွင့်မည်"
                                            }}
                                        </button>
                                    </span>
                                </div>
                            </li>

                            <li class="nav-item" v-if="$auth.check()">
                                <a
                                    class="nav-link nav-link-icon"
                                    @click="
                                        $router.push('/deposit').catch(() => {})
                                    "
                                    data-toggle="collapse"
                                    data-target="#navbar-default"
                                    aria-controls="navbar-default"
                                >
                                    <span class="nav-link-inner--text"
                                        >{{
                                            $store.state.language === "en"
                                                ? "Wallet"
                                                : "ပိုက်ဆံအိတ်"
                                        }}
                                        :
                                        <b
                                            >{{
                                                Number(
                                                    $store.state.amount
                                                ).toLocaleString()
                                            }}
                                            {{
                                                $store.state.language === "en"
                                                    ? "MMK"
                                                    : "ကျပ်"
                                            }}</b
                                        >
                                        <i class="ni ni-fat-add"></i
                                    ></span>
                                </a>
                            </li>
                            <li class="nav-item dropdown" v-if="$auth.check()">
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

                                <div
                                    class="dropdown-menu dropdown-menu-right"
                                    aria-labelledby="navbar-default_dropdown_1"
                                >
                                    <div
                                        class="dropdown-item"
                                        @click="redirectLink('deposit')"
                                    >
                                        <i class="ni ni-credit-card"></i>
                                        {{
                                            $store.state.language === "en"
                                                ? "Deposit"
                                                : "ငွေသွင်း"
                                        }}
                                    </div>

                                    <div
                                        class="dropdown-item"
                                        @click="redirectLink('withdraw')"
                                    >
                                        <i class="ni ni-money-coins"></i>
                                        {{
                                            $store.state.language === "en"
                                                ? "Withdraw"
                                                : "ငွေထုတ်"
                                        }}
                                    </div>
                                    <div
                                        class="dropdown-item"
                                        @click="redirectLink('history')"
                                    >
                                        <i class="ni ni-folder-17"></i>
                                        {{
                                            $store.state.language === "en"
                                                ? "History"
                                                : "ငွေသွင်း / ငွေထုတ် မှတ်တမ်းများ"
                                        }}
                                    </div>
                                    <div
                                        class="dropdown-item"
                                        @click="redirectLink('betslip-history')"
                                    >
                                        <i class="ni ni-single-copy-04"></i>
                                        {{
                                            $store.state.language === "en"
                                                ? "Betslip History"
                                                : "ဘောက်ချာများ"
                                        }}
                                    </div>
                                    <div
                                        class="dropdown-item"
                                        @click="redirectLink('unit-list')"
                                        v-if="this.$auth.check('comissioner')"
                                    >
                                        <i class="ni ni-archive-2"></i>
                                        {{
                                            $store.state.language === "en"
                                                ? "Unit List"
                                                : "ယူနစ် စာရင်း"
                                        }}
                                    </div>
                                    <div
                                        class="dropdown-item"
                                        @click="redirectLink('comission')"
                                        v-if="this.$auth.check('comissioner')"
                                    >
                                        <i class="ni ni-bullet-list-67"></i>
                                        {{
                                            $store.state.language === "en"
                                                ? "Comission"
                                                : "ကော်မရှင်"
                                        }}
                                    </div>
                                    <div
                                        class="dropdown-item"
                                        @click="redirectLink('ledger')"
                                        v-if="this.$auth.check('comissioner')"
                                    >
                                        <i class="ni ni-tv-2"></i>
                                        {{
                                            $store.state.language === "en"
                                                ? "Ledger"
                                                : "လက်ဂျာ"
                                        }}
                                    </div>

                                    <div class="dropdown-divider"></div>
                                    <div
                                        class="dropdown-item text-danger"
                                        @click="logout"
                                    >
                                        <i class="ni ni-lock-circle-open"></i>
                                        {{
                                            $store.state.language === "en"
                                                ? "Logout"
                                                : "ထွက်မည်"
                                        }}
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </Sticky>
    </div>
</template>
<script>
import { Toast, Dialog, Sticky } from 'vant';

export default {
  components: { Sticky },
  data() {
    return {
      imageLink: `https://ui-avatars.com/api/?name=${
        this.$auth.user().email
      }&background=0D8ABC&color=fff`,
    };
  },
  methods: {
    closeNavCollapse() {
      $('#navbar-default').collapse('hide');
    },
    setLangLocalstorage(language) {
      localStorage.setItem('language', language);
      this.$store.commit('setLanguage', language);
      $('#navbar-default').collapse('hide');
    },
    redirectLink(link) {
      this.$router.push(`/${link}`).catch(() => {});
      $('#navbar-default').collapse('hide');
    },
    redirectRoute(path) {
      if (this.$auth.check('normal')) {
        if (path === '2d') {
          this.$router.push('/user/2d');
        } else {
          this.$router.push('/user/3d');
        }
        return true;
      }
      if (path === '2d') {
        this.$router.push('/comissioner/2d');
      } else {
        this.$router.push('/comissioner/3d');
      }
      return true;
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
          $('#navbar-default').collapse('hide');
        })
        .catch(() => {
          $('#navbar-default').collapse('hide');
        });
    },
  },
};
</script>
<style scoped>
.nav-link {
    cursor: pointer;
}
.navbar-brand.brand-text {
    font-size: 20px;
    color: red;
    margin-left: 0px;
    margin-right: 10px;
}
.navbar-brand {
    font-size: 16px;
    margin-left: 20px;
    margin-right: 20px;
    cursor: pointer;
}
.dropdown-item {
    cursor: pointer;
}
@media (max-width: 767.98px) {
    .navbar-brand {
        font-size: 14px;
        margin-left: 0px;
        margin-right: 0px;
    }
}
</style>

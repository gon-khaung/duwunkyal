<template>
    <div>
        <div class="container my-5">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-7">
                    <div class="card border-0 mb-0 auth-card">
                        <div class="card-body px-lg-5 py-lg-5">
                            <div class="text-center text-muted mb-4">
                                <b>{{
                                    $store.state.language === "en"
                                        ? "Log in with credentials"
                                        : "phone နှင့် password ဖြင့် အကောင့်ဝင်မည်။"
                                }}</b>
                                <div class="error" v-if="error">
                                    {{
                                        $store.state.language === "en"
                                            ? "Fail to Login! Please Try Again"
                                            : "အကောင့်ဝင်ခြင်း ကျဆုံးပါသည်။ တဖန်ပြန်လည် ကြိုးစားကြည့်ပါ။"
                                    }}
                                </div>
                            </div>
                            <form role="form">
                                <small class="text-danger">{{
                                    errors.phone
                                }}</small>
                                <div class="form-group mb-3">
                                    <div
                                        class="
                                            input-group
                                            input-group-merge
                                            input-group-alternative
                                        "
                                    >
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"
                                                ><i class="fas fa-phone"></i
                                            ></span>
                                        </div>
                                        <input
                                            class="form-control pl-2"
                                            placeholder="Phone"
                                            type="text"
                                            v-model="phone"
                                            @keyup.enter="
                                                focusOnPasswordInputBox
                                            "
                                        />
                                    </div>
                                </div>
                                <small class="text-danger">{{
                                    errors.password
                                }}</small>
                                <div class="form-group">
                                    <div
                                        class="
                                            input-group
                                            input-group-merge
                                            input-group-alternative
                                        "
                                    >
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"
                                                ><i
                                                    class="
                                                        ni ni-lock-circle-open
                                                    "
                                                ></i
                                            ></span>
                                        </div>
                                        <input
                                            class="form-control pl-2"
                                            placeholder="Password"
                                            type="password"
                                            ref="password"
                                            v-model="password"
                                            @keyup.enter="loginWithPhone"
                                        />
                                        <i
                                            class="far fa-eye showable-password"
                                            v-if="isShow"
                                            @click="showablePassword"
                                        ></i>
                                        <i
                                            v-if="!isShow"
                                            class="
                                                fas
                                                fa-eye-slash
                                                showable-password
                                            "
                                            @click="showablePassword"
                                        ></i>
                                    </div>
                                </div>
                                <div
                                    class="
                                        custom-control
                                        custom-control-alternative
                                        custom-checkbox
                                    "
                                >
                                    <input
                                        class="custom-control-input"
                                        id=" customCheckLogin"
                                        type="checkbox"
                                    />
                                    <label
                                        class="custom-control-label"
                                        for=" customCheckLogin"
                                    >
                                        <b class="text-muted">{{
                                            $store.state.language === "en"
                                                ? "Remember me"
                                                : "ဒီအကောင့်ကို မှတ်ထားပေးပါ။"
                                        }}</b>
                                    </label>
                                </div>
                                <div class="text-center">
                                    <button
                                        type="button"
                                        class="btn btn-primary my-4"
                                        @click="loginWithPhone"
                                    >
                                        <div v-if="!isSignin">
                                            {{
                                                $store.state.language === "en"
                                                    ? "Sign in"
                                                    : "အကောင့် ဝင်မည်။"
                                            }}
                                        </div>

                                        <Loading
                                            color="#ffffff"
                                            v-if="isSignin"
                                            size="24"
                                            class="px-4 py-0"
                                        />
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-6 text-center">
                            <a
                                @click="$router.push('/auth/register')"
                                class="new-account-text"
                                ><b>{{
                                    $store.state.language === "en"
                                        ? "Create new account"
                                        : "အကောင့်အသစ်ဖွင့်မည်။"
                                }}</b></a
                            >
                        </div>

                        <div class="col-6 text-center">
                            <a
                                data-toggle="modal"
                                data-target="#forgetPassword"
                                class="new-account-text"
                                ><b>{{
                                    $store.state.language === "en"
                                        ? "Forgot Password?"
                                        : "လျို့ဝှက်နံပါတ် မေ့နေပါသလား?"
                                }}</b></a
                            >
                        </div>
                        <!-- === only amount === -->
                        <div class="col-4">
                            <div
                                class="modal fade"
                                id="forgetPassword"
                                tabindex="-1"
                                role="dialog"
                                aria-labelledby="modal-form"
                                aria-hidden="true"
                            >
                                <div
                                    class="
                                        modal-dialog
                                        modal-
                                        modal-dialog-centered
                                    "
                                    role="document"
                                >
                                    <div class="modal-content">
                                        <div class="modal-body p-5">
                                            <b>
                                                Please direct contact to
                                                customer service -
                                                <span class="text-danger"
                                                    >09788837668</span
                                                >
                                            </b>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { Toast, Loading } from 'vant';

export default {
  components: { Loading },
  data() {
    return {
      phone: null,
      password: null,
      error: false,
      errors: {},
      isSignin: false,
      isShow: false,
    };
  },
  methods: {
    showablePassword() {
      if (this.isShow) {
        this.$refs.password.type = 'password';
      } else {
        this.$refs.password.type = 'text';
      }
      this.isShow = !this.isShow;
    },
    focusOnPasswordInputBox() {
      this.$refs.password.focus();
    },
    /**
         * login with phone
         */
    async loginWithPhone() {
      this.isSignin = true;
      this.errors = {};
      if (!this.phone) {
        this.errors.phone = this.$store.state.language === 'en'
          ? 'Required Phone'
          : 'Phone လိုအပ်ပါသည်။';
        this.isSignin = false;
        return false;
      }
      if (!this.password) {
        this.errors.password = this.$store.state.language === 'en'
          ? 'Required Password'
          : 'Password လိုအပ်ပါသည်။';
        this.isSignin = false;
        return false;
      }
      try {
        await this.$auth
          .login({
            data: {
              phone: this.phone,
              password: this.password,
            },
            staySignedIn: true,
            autoLogin: true,
            redirect: '/faq',
          })
          .then((res) => {
            Toast.success(
              this.$store.state.language === 'en'
                ? 'Logged In!'
                : 'အကောင့်ဝင်ပြီးပါပြီ။',
            );
            if (res.data.data.roles === 'normal') this.$router.push('/user/2d');
            else this.$router.push('/comissioner/2d');
          });
      } catch (err) {
        this.error = true;
      }
      this.isSignin = false;
      return true;
    },
  },
  mounted() {
    if (this.$auth.check()) this.$router.push('/');
  },
};
</script>

<style scoped>
.showable-password {
    position: absolute;
    right: 15px;
    top: 15px;
    cursor: pointer;
    z-index: 1000;
}
.new-account-text {
    cursor: pointer;
}
.error {
    margin-bottom: 13px;
    height: 40px;
    display: flex;
    align-items: center;
    color: red;
    border: 1px solid red;
    border-radius: 8px;
    padding: 0px 15px;
    background: #ff000014;
    font-weight: bold;
}
.auth-card {
    background: #f7fafc;
}
</style>

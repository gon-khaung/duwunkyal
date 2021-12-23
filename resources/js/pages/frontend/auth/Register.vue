<template>
    <div>
        <!-- Page content -->
        <div class="container my-5">
            <!-- Table -->
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-7">
                    <div class="card auth-card border-0">
                        <div class="card-body px-lg-5 py-lg-5">
                            <div class="text-center text-muted mb-4">
                                <b>{{
                                    $store.state.language === "en"
                                        ? "Register with credentials"
                                        : "ဒါမှမဟုတ် phone နှင့် password ဖြင့် အကောင့်အသစ်ဖွင့်မည်။"
                                }}</b>
                                <div class="error" v-if="error">
                                    {{
                                        $store.state.language === "en"
                                            ? "Fail to Register! Please Try Again"
                                            : "အကောင့်အသစ်ဖွင့်ခြင်း ကျဆုံးပါသည်။ တဖန်ပြန်လည်ကြိုးစားကြည့်ပါ။"
                                    }}
                                </div>
                            </div>
                            <form role="form">
                                <small class="text-danger">{{
                                    errors.name
                                }}</small>
                                <div class="form-group">
                                    <div
                                        class="
                                            input-group
                                            input-group-merge
                                            input-group-alternative
                                            mb-3
                                        "
                                    >
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"
                                                ><i class="ni ni-hat-3"></i
                                            ></span>
                                        </div>
                                        <input
                                            class="form-control pl-2"
                                            placeholder="Name"
                                            type="text"
                                            v-model="name"
                                            @keyup.enter="focusOnPhoneInputBox"
                                        />
                                    </div>
                                </div>
                                <small class="text-danger">{{
                                    errors.phone
                                }}</small>
                                <div class="form-group">
                                    <div
                                        class="
                                            input-group
                                            input-group-merge
                                            input-group-alternative
                                            mb-3
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
                                            type="phone"
                                            v-model="phone"
                                            ref="phone"
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
                                            @keyup.enter="
                                                focusOnConfirmPasswordInputBox
                                            "
                                        />
                                        <i
                                            class="far fa-eye showable-password"
                                            v-if="isShowPassword"
                                            @click="showablePassword"
                                        ></i>
                                        <i
                                            v-if="!isShowPassword"
                                            class="
                                                fas
                                                fa-eye-slash
                                                showable-password
                                            "
                                            @click="showablePassword"
                                        ></i>
                                    </div>
                                </div>
                                <small class="text-danger">{{
                                    errors.confirm_password
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
                                            placeholder="Confirm Password"
                                            type="password"
                                            ref="confirm_password"
                                            v-model="confirm_password"
                                            @keyup.enter="registerWithPhone"
                                        />
                                        <i
                                            class="far fa-eye showable-password"
                                            v-if="isShowConfirmPassword"
                                            @click="showableConfirmPassword"
                                        ></i>
                                        <i
                                            v-if="!isShowConfirmPassword"
                                            class="
                                                fas
                                                fa-eye-slash
                                                showable-password
                                            "
                                            @click="showableConfirmPassword"
                                        ></i>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button
                                        type="button"
                                        class="btn btn-primary mt-4"
                                        @click="registerWithPhone"
                                    >
                                        <b v-if="!isSignUp">{{
                                            $store.state.language === "en"
                                                ? "Create account"
                                                : "အကောင့် ဖွင့်မည်။"
                                        }}</b>

                                        <Loading
                                            color="#ffffff"
                                            v-if="isSignUp"
                                            size="24"
                                            class="px-4 py-0"
                                        />
                                    </button>
                                </div>
                            </form>
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
      isSignUp: false,
      errors: {},
      name: null,
      phone: null,
      error: false,
      password: null,
      confirm_password: null,
      isShowPassword: false,
      isShowConfirmPassword: false,
    };
  },
  methods: {
    showablePassword() {
      if (this.isShowPassword) {
        this.$refs.password.type = 'password';
      } else {
        this.$refs.password.type = 'text';
      }
      this.isShowPassword = !this.isShowPassword;
    },
    showableConfirmPassword() {
      if (this.isShowConfirmPassword) {
        this.$refs.confirm_password.type = 'password';
      } else {
        this.$refs.confirm_password.type = 'text';
      }
      this.isShowConfirmPassword = !this.isShowConfirmPassword;
    },
    focusOnConfirmPasswordInputBox() {
      this.$refs.confirm_password.focus();
    },
    focusOnPasswordInputBox() {
      this.$refs.password.focus();
    },
    focusOnPhoneInputBox() {
      this.$refs.phone.focus();
    },
    /**
         * register with
         */
    async registerWithPhone() {
      this.isSignUp = true;
      this.errors = {};
      if (!this.name) {
        this.errors.name = this.$store.state.language === 'en'
          ? 'Required Name'
          : 'နာမည် လိုအပ်ပါသည်။';
        this.isSignUp = false;
        return false;
      }
      if (!this.phone) {
        this.errors.phone = this.$store.state.language === 'en'
          ? 'Required Phone'
          : 'Phone လိုအပ်ပါသည်။';
        this.isSignUp = false;
        return false;
      }
      if (!this.password) {
        this.errors.password = this.$store.state.language === 'en'
          ? 'Required Password'
          : 'Password လိုအပ်ပါသည်။';
        this.isSignUp = false;
        return false;
      }
      if (!this.confirm_password) {
        this.errors.confirm_password = this.$store.state.language === 'en'
          ? 'Required Confirm Password'
          : 'Confirm Password လိုအပ်ပါသည်။';
        this.isSignUp = false;
        return false;
      }
      if (this.password !== this.confirm_password) {
        this.errors.confirm_password = this.$store.state.language === 'en'
          ? 'Password Not Match'
          : 'လျှို့ဝှက်နံပါတ် မတူညီပါ';
        this.isSignUp = false;
        return false;
      }
      try {
        await this.$auth
          .register({
            data: {
              phone: this.phone,
              password: this.password,
              name: this.name,
              confirmPassword: this.confirm_password,
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
        console.log(err);
      }
      this.isSignUp = false;
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
.error {
    margin-bottom: 10px;
    margin-top: 10px;
    padding: 5px 15px;
    display: flex;
    align-items: center;
    color: red;
    border: 1px solid red;
    border-radius: 8px;
    background: #ff000014;
    font-weight: bold;
}
.auth-card {
    background: #f7fafc;
}
</style>

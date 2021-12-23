<template>
    <div>
        <section class="ftco-section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-7 col-lg-5">
                        <div class="wrap">
                            <div class="login-wrap p-4 p-md-5">
                                <div class="d-flex">
                                    <div class="w-100">
                                        <h3 class="mb-4">Log In</h3>
                                    </div>
                                </div>
                                <form action="#" class="signin-form">
                                    <div class="form-group mt-3">
                                        <input
                                            type="text"
                                            class="form-control"
                                            required
                                        />
                                        <label
                                            class="form-control-placeholder"
                                            for="username"
                                            >Username</label
                                        >
                                    </div>
                                    <div class="form-group">
                                        <input
                                            id="password-field"
                                            type="password"
                                            class="form-control"
                                            required
                                        />
                                        <label
                                            class="form-control-placeholder"
                                            for="password"
                                            >Password</label
                                        >
                                        <span
                                            toggle="#password-field"
                                            class="
                                                fa fa-fw fa-eye
                                                field-icon
                                                toggle-password
                                            "
                                        ></span>
                                    </div>
                                    <div class="form-group">
                                        <button
                                            type="submit"
                                            class="
                                                form-control
                                                btn btn-primary
                                                rounded
                                                submit
                                                px-3
                                            "
                                        >
                                            Sign In
                                        </button>
                                    </div>
                                    <div class="form-group d-md-flex">
                                        <div class="w-50 text-left">
                                            <label
                                                class="
                                                    checkbox-wrap
                                                    checkbox-primary
                                                    mb-0
                                                "
                                                >Remember Me
                                                <input
                                                    type="checkbox"
                                                    checked
                                                />
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="w-50 text-md-right">
                                            <a href="#">Forgot Password</a>
                                        </div>
                                    </div>
                                </form>
                                <p class="text-center">
                                    Not a member?
                                    <a data-toggle="tab" href="#signup"
                                        >Register</a
                                    >
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
import { Toast } from 'vant';

export default {
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
        this.errors.phone = 'Required Phone';
        this.isSignin = false;
        return false;
      }
      if (!this.password) {
        this.errors.password = 'Required Password';
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
            Toast.success('Logged In!');
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

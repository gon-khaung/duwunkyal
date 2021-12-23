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
                                        <h3 class="mb-4">Register</h3>
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
                                    <div class="form-group mt-3">
                                        <input
                                            type="text"
                                            class="form-control"
                                            required
                                        />
                                        <label
                                            class="form-control-placeholder"
                                            for="username"
                                            >Email</label
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
                                        <input
                                            id="password-field"
                                            type="password"
                                            class="form-control"
                                            required
                                        />
                                        <label
                                            class="form-control-placeholder"
                                            for="password"
                                            >Confirm Password</label
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
                                </form>
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
        this.errors.name = 'Required Name';
        this.isSignUp = false;
        return false;
      }
      if (!this.phone) {
        this.errors.phone = 'Required Phone';
        this.isSignUp = false;
        return false;
      }
      if (!this.password) {
        this.errors.password = 'Required Password';
        this.isSignUp = false;
        return false;
      }
      if (!this.confirm_password) {
        this.errors.confirm_password = 'Required Confirm Password';
        this.isSignUp = false;
        return false;
      }
      if (this.password !== this.confirm_password) {
        this.errors.confirm_password = 'Password Not Match';
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
            Toast.success('Logged In!');
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

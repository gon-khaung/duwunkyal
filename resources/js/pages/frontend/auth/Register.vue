<template>
    <div>
        <NavBar />
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

                                <div class="form-group mt-3">
                                    <input
                                        type="text"
                                        class="form-control"
                                        required
                                        v-model="name"
                                    />
                                    <label
                                        class="form-control-placeholder"
                                        for="username"
                                        >Username</label
                                    >
                                    <small class="text-danger">{{
                                        errors.name
                                    }}</small>
                                </div>
                                <div class="form-group mt-3">
                                    <input
                                        type="text"
                                        class="form-control"
                                        required
                                        v-model="email"
                                    />
                                    <label
                                        class="form-control-placeholder"
                                        for="username"
                                        >Email</label
                                    >
                                    <small class="text-danger">{{
                                        errors.email
                                    }}</small>
                                </div>
                                <div class="form-group">
                                    <input
                                        id="password-field"
                                        type="password"
                                        class="form-control"
                                        required
                                        v-model="password"
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
                                    <small class="text-danger">{{
                                        errors.password
                                    }}</small>
                                </div>
                                <div class="form-group">
                                    <input
                                        id="password-field"
                                        type="password"
                                        class="form-control"
                                        required
                                        v-model="confirm_password"
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
                                    <small class="text-danger">{{
                                        errors.confirm_password
                                    }}</small>
                                </div>
                                <div class="form-group">
                                    <button
                                        type="button"
                                        class="
                                            form-control
                                            btn btn-primary
                                            rounded
                                            px-3
                                        "
                                        @click="registerWithEmail()"
                                    >
                                        Sign In
                                    </button>
                                </div>
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
      email: null,
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
    async registerWithEmail() {
      this.isSignUp = true;
      this.errors = {};
      if (!this.name) {
        this.errors.name = 'Required Name';
        this.isSignUp = false;
        return false;
      }
      if (!this.email) {
        this.errors.email = 'Required Email';
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
              email: this.email,
              password: this.password,
              name: this.name,
              confirmPassword: this.confirm_password,
            },
            staySignedIn: true,
            autoLogin: true,
            rememberMe: true,
            redirect: 'asdf',
          })
          .then((res) => {
            Toast.success('Logged In!');
            this.$router.go(-2);
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
</style>

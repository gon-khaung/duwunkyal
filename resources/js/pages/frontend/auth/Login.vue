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
                                        <h3 class="mb-4">Log In</h3>
                                    </div>
                                </div>
                                <div class="error" v-if="error">
                                    {{ "Fail to Login! Please Try Again" }}
                                </div>
                                <div class="form-group mt-3">
                                    <input
                                        type="text"
                                        class="form-control"
                                        v-model="email"
                                        required
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
                                        ref="password"
                                    />
                                    <label
                                        class="form-control-placeholder"
                                        for="password"
                                        >Password</label
                                    >
                                    <span
                                        @click="showablePassword"
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
                                    <button
                                        type="button"
                                        class="
                                            form-control
                                            btn btn-primary
                                            rounded
                                            submit
                                            px-3
                                        "
                                        @click="loginWithEmail()"
                                    >
                                        Sign In
                                    </button>
                                </div>
                                <div
                                    class="
                                        form-group
                                        d-flex
                                        justify-content-between
                                    "
                                >
                                    <div class="text-left">
                                        <label
                                            class="
                                                checkbox-wrap checkbox-primary
                                                mb-0
                                            "
                                            >Remember Me
                                            <input type="checkbox" checked />
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="text-right">
                                        <a
                                            href="#"
                                            @click="
                                                $router.push(
                                                    '/auth/forget-password'
                                                )
                                            "
                                            class="text-danger"
                                            >Forgot Password</a
                                        >
                                    </div>
                                </div>
                                <p class="text-center">
                                    Not a member?
                                    <a
                                        data-toggle="tab"
                                        href=""
                                        @click="$router.push('/auth/register')"
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
      email: null,
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
         * login with email
         */
    async loginWithEmail() {
      this.isSignin = true;
      this.errors = {};
      if (!this.email) {
        this.errors.email = 'Required Email';
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
              email: this.email,
              password: this.password,
            },
            staySignedIn: true,
            autoLogin: true,
            rememberMe: true,
            redirect: 'af',
          })
          .then((res) => {
            Toast.success('Logged In!');
            this.$router.go(-2);
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
.toggle-password {
    cursor: pointer;
}
</style>

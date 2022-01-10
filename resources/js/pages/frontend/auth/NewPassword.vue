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
                    <h3 class="mb-4">Change New Password</h3>
                  </div>
                </div>
                <div class="form-group">
                  <input
                    id="password-field"
                    type="password"
                    class="form-control"
                    required
                    v-model="password"
                  />
                  <label class="form-control-placeholder" for="password"
                    >Password</label
                  >
                  <span
                    toggle="#password-field"
                    class="fa fa-fw fa-eye field-icon toggle-password"
                  ></span>
                  <small class="text-danger">{{ errors.password }}</small>
                </div>
                <div class="form-group">
                  <input
                    id="password-field"
                    type="password"
                    class="form-control"
                    required
                    v-model="confirm_password"
                  />
                  <label class="form-control-placeholder" for="password"
                    >Confirm Password</label
                  >
                  <span
                    toggle="#password-field"
                    class="fa fa-fw fa-eye field-icon toggle-password"
                  ></span>
                  <small class="text-danger">{{
                    errors.confirm_password
                  }}</small>
                </div>
                <div class="form-group">
                  <button
                    type="button"
                    class="form-control btn btn-primary rounded px-3"
                    @click="registerWithEmail()"
                  >
                    Confirm
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
      errors: {},
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
    /**
     * register with
     */
    async registerWithEmail() {
      this.errors = {};
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
        const res = await axios.post('auth/passwordChange', {
          password: this.password,
          id: this.$route.query.userId,
        });
      } catch (err) {
        this.error = true;
        console.log(err);
      }
      this.isSignUp = false;
      return true;
    },
    async checkToken() {
      try {
        const res = await axios.post('auth/check-reset-token', {
          token: this.$route.query.token,
          id: this.$route.query.userId,
        });
      } catch (error) {
        this.$router.push('/');
      }
    },
  },
  mounted() {
    this.checkToken();
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

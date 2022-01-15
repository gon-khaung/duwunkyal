<template>
  <div>
    <NavBar />
    <div class="ftco-section">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-7 col-lg-5">
            <div class="wrap">
              <div class="login-wrap p-4 p-md-5">
                <div class="d-flex">
                  <div class="w-100">
                    <h3 class="mb-4">Find your account by Email</h3>
                    <div>
                      <span class="text-danger" v-if="error"
                        >Invalid Email</span
                      >
                      <small class="text-info" v-if="success"
                        >We have sent password reset link! Please your
                        gmail!</small
                      >
                    </div>
                  </div>
                </div>
                <div class="form-group mt-3">
                  <input
                    type="text"
                    class="form-control"
                    v-model="email"
                    required
                  />
                  <label class="form-control-placeholder" for="username"
                    >Email</label
                  >
                  <small class="text-danger">{{ errors.email }}</small>
                </div>
                <div class="form-group">
                  <button
                    type="button"
                    class="form-control btn btn-primary rounded submit px-3"
                    @click="sendPasswordReset()"
                  >
                    Send Reset Mail
                  </button>
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
import { Toast } from 'vant';

export default {
  data() {
    return {
      email: null,
      success: null,
      error: false,
      errors: {},
    };
  },
  methods: {
    /**
     * login with email
     */
    async sendPasswordReset() {
      this.errors = {};
      if (!this.email) {
        this.errors.email = 'Required Email';
        this.isSignin = false;
        return false;
      }
      try {
        const res = await axios.post('auth/password-reset', {
          email: this.email,
        });
        this.success = true;
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
</style>

<template>
    <!-- Main content -->
    <div class="main-content">
        <!-- Header -->
        <div class="header bg-gradient-primary py-6 py-lg-8 pt-lg-9">
            <div class="container">
                <div class="header-body text-center mb-7">
                    <div class="row justify-content-center">
                        <div class="col-xl-5 col-lg-6 col-md-8 px-5">
                            <h1 class="text-white">
                                {{ "Welcome!" }}
                            </h1>
                            <p class="text-lead text-white">
                                {{ "You can go to Duwunkyal admin panel." }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="separator separator-bottom separator-skew zindex-100">
                <svg
                    x="0"
                    y="0"
                    viewBox="0 0 2560 100"
                    preserveAspectRatio="none"
                    version="1.1"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <polygon
                        class="fill-default"
                        points="2560 0 2560 100 0 100"
                    ></polygon>
                </svg>
            </div>
        </div>
        <!-- Page content -->
        <div class="container mt--8 pb-5">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-7">
                    <div class="card bg-white border-0 mb-0">
                        <div class="card-body px-lg-5 py-lg-5">
                            <div class="text-center text-muted mb-5">
                                <h4>
                                    {{ "Log in to Admin Panel" }}
                                </h4>
                                <div class="error" v-if="error">
                                    {{ "Fail to Login! Please Try Again" }}
                                </div>
                            </div>
                            <form role="form">
                                <small class="text-danger">{{
                                    errors.phone
                                }}</small>
                                <div class="form-group mb-4">
                                    <div
                                        class="
                                            input-group
                                            input-group-merge
                                            input-group-alternative
                                        "
                                    >
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"
                                                ><i class="fas fa-email"></i
                                            ></span>
                                        </div>
                                        <input
                                            class="form-control pl-2"
                                            placeholder="Email"
                                            v-model="email"
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
                                            ref="password"
                                            type="password"
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
                                            "Remember me"
                                        }}</b>
                                    </label>
                                </div>
                                <div class="text-center">
                                    <button
                                        type="button"
                                        class="btn btn-primary mt-4"
                                        @click="loginWithPhone"
                                    >
                                        <div v-if="!isLogin">
                                            {{ "Sign in" }}
                                        </div>
                                        <Loading
                                            color="#ffffff"
                                            v-if="isLogin"
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
import { Loading } from 'vant';

export default {
  components: { Loading },
  data() {
    return {
      email: null,
      password: null,
      error: false,
      errors: {},
      isLogin: false,
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
      this.isLogin = true;
      this.errors = {};
      if (!this.email) {
        this.errors.email = 'Required Phone';
        this.isLogin = false;
        return false;
      }
      if (!this.password) {
        this.errors.password = 'Required Password';
        this.isLogin = false;
        return false;
      }
      try {
        await this.$auth.login({
          data: {
            email: this.email,
            password: this.password,
          },
          redirect: '/admin/products',
          staySignedIn: true,
          autoLogin: true,
        });
        Toast.success('Logged In!');
      } catch (err) {
        this.error = true;
      }
      this.isLogin = false;
      return true;
    },
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
.main-content {
    background: #172b4d;
    height: 100vh;
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
</style>

<template>
  <div>
    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
      <div class="humberger__menu__logo">
        <a href="#"><img src="img/logo.png" alt="" /></a>
      </div>
      <div class="humberger__menu__widget">
        <div class="header__top__right__auth login_auth">
          <a
            href=""
            @click="$router.push('/auth/login')"
            v-if="!$auth.check()"
            class="mr-2"
            ><i class="fa fa-user"></i> Login
          </a>
          <a
            href=""
            @click="$router.push('/auth/register')"
            v-if="!$auth.check()"
            ><i class="fa fa-user"></i> Register
          </a>
          <a href="" @click.prevent="logout()" v-if="$auth.check()"
            ><i class="fa fa-user"></i> Log Out
          </a>
        </div>
      </div>
      <nav class="humberger__menu__nav mobile-menu">
        <ul>
          <li
            :class="
              !linkIsActive('/shop') &&
              !linkIsActive('/contact') &&
              !linkIsActive('/product') &&
              !linkIsActive('/checkout') &&
              !linkIsActive('/contact')
                ? 'active'
                : ''
            "
          >
            <a href="/">Home</a>
          </li>
          <li :class="linkIsActive('/shop') ? 'active' : ''">
            <a href="/shop">Shop</a>
          </li>
          <li :class="linkIsActive('/contact') ? 'active' : ''">
            <a href="/contact">Contact</a>
          </li>
        </ul>
      </nav>
      <div id="mobile-menu-wrap"></div>
      <div class="header__top__right__social">
        <a href="#"><i class="fa fa-facebook"></i></a>
        <a href="#"><i class="fas fa-phone"></i></a>
        <a href="#"><i class="fab fa-telegram-plane"></i></a>
        <a href="#"><i class="fab fa-viber"></i></a>
      </div>
      <div class="humberger__menu__contact">
        <ul>
          <li>
            <i class="fa fa-envelope"></i>
            {{ $store.state.contact.email }}
          </li>
        </ul>
      </div>
    </div>
    <!-- Humberger End -->

    <!-- Header Section Begin -->
    <header class="header">
      <div class="header__top">
        <div class="container">
          <div class="row">
            <div class="col-lg-6">
              <div class="header__top__left">
                <ul>
                  <li>
                    <i class="fa fa-envelope"></i>
                    {{ $store.state.contact.email }}
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="header__top__right">
                <div class="header__top__right__social">
                  <a href="#"><i class="fa fa-facebook"></i></a>
                  <a href="#"><i class="fas fa-phone"></i></a>
                  <a href="#"><i class="fab fa-telegram-plane"></i></a>
                  <a href="#"><i class="fab fa-viber"></i></a>
                </div>
                <div class="header__top__right__auth" v-if="!$auth.check()">
                  <a href="" @click="$router.push('/auth/login')"
                    ><i class="fa fa-user"></i> Login
                  </a>
                </div>

                <div
                  class="header__top__right__auth ml-2"
                  v-if="!$auth.check()"
                >
                  <a href="" @click="$router.push('/auth/register')"
                    ><i class="fa fa-user"></i> Register
                  </a>
                </div>
                <div class="header__top__right__auth" v-if="$auth.check()">
                  <a href="" @click.prevent="logout()"
                    ><i class="fas fa-sign-out-alt"></i>Log Out
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="container">
        <div
          class="row"
          v-if="
            !$route.path.includes('new-password') &&
            !$route.path.includes('forget-password') &&
            !$route.path.includes('login') &&
            !$route.path.includes('register')
          "
        >
          <div class="col-lg-3">
            <div class="header__logo">
              <a href="./index.html"><img src="img/logo.png" alt="" /></a>
            </div>
          </div>
          <div class="col-lg-6">
            <nav class="header__menu">
              <ul class="text-center">
                <li
                  :class="
                    !linkIsActive('/shop') &&
                    !linkIsActive('/contact') &&
                    !linkIsActive('/product') &&
                    !linkIsActive('/checkout')
                      ? 'active'
                      : ''
                  "
                >
                  <a href="" @click="$router.push('/')">Home</a>
                </li>
                <li :class="linkIsActive('/shop') ? 'active' : ''">
                  <a href="" @click="$router.push('/shop')">Shop</a>
                </li>
                <li :class="linkIsActive('/contact') ? 'active' : ''">
                  <a href="" @click="$router.push('/contact')">Contact</a>
                </li>
              </ul>
            </nav>
          </div>
          <div class="col-lg-3">
            <div class="header__cart">
              <ul>
                <li>
                  <a href="#" @click.prevent="$router.push('/checkout')"
                    ><i class="fa fa-shopping-bag"></i>
                    <span>{{ $store.state.cart.length }}</span></a
                  >
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="humberger__open">
          <i class="fa fa-bars"></i>
        </div>
      </div>
    </header>
    <!-- Header Section End -->
    <!-- Hero Section Begin -->
    <section
      class="hero"
      v-if="
        !$route.path.includes('login') &&
        !$route.path.includes('register') &&
        !$route.path.includes('checkout') &&
        !$route.path.includes('new-password') &&
        !$route.path.includes('forget-password')
      "
    >
      <div class="container">
        <div class="row">
          <div class="col-lg-3" v-if="isDep">
            <div class="hero__categories">
              <div class="hero__categories__all">
                <i class="fa fa-bars"></i>
                <span>All departments</span>
              </div>
              <ul :style="isNone ? 'display: none' : ''">
                <li>
                  <a
                    href=""
                    @click="
                      $router.push(`/shop/category/${category.id}`), makeVisible
                    "
                    v-for="(category, index) in categories"
                    :key="index"
                    >{{ category.name }}</a
                  >
                </li>
              </ul>
            </div>
          </div>
          <div class="col-lg-9">
            <div class="hero__search" v-if="isSearch">
              <div class="hero__search__form">
                <form action="#">
                  <input
                    type="text"
                    placeholder="What do yo u need?"
                    v-model="search"
                  />
                  <button @click.prevent="searchProducts" class="site-btn">
                    SEARCH
                  </button>
                </form>
              </div>
              <div class="hero__search__phone">
                <div class="hero__search__phone__icon">
                  <i class="fa fa-phone"></i>
                </div>
                <div class="hero__search__phone__text">
                  <h5>{{ $store.state.contact.phone }}</h5>
                  <span>support 24/7 time</span>
                </div>
              </div>
            </div>
            <div
              class="hero__item set-bg"
              data-setbg="https://thetkhine.com/wp-content/uploads/2021/07/Sunset1-768x512.jpeg"
              v-if="isSecondHead"
            >
              <div class="hero__text">
                <span>FRUIT FRESH</span>
                <h2>Vegetable <br />100% Organic</h2>
                <p>Free Pickup and Delivery Available</p>
                <a href="" class="primary-btn" @click="$router.push('/shop')"
                  >SHOP NOW</a
                >
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Hero Section End -->
  </div>
</template>
<script>
import { Toast, Dialog } from 'vant';

export default {
  props: {
    isSearch: {
      type: Boolean,
      default: true,
    },
    isSecondHead: {
      type: Boolean,
      default: true,
    },
    isDep: {
      type: Boolean,
      default: true,
    },
    isNone: {
      type: Boolean,
      default: false,
    },
  },
  data() {
    return {
      categories: [],
      search: null,
    };
  },
  methods: {
    searchProducts() {
      try {
        this.$router.push({
          path: '/shop',
          query: { search: this.search },
        });
      } catch (error) {
        console.log(error);
      }
    },
    /* example link = '/settings' */
    linkIsActive(link) {
      const paths = Array.isArray(link) ? link : [link];
      const res = paths.some((path) => this.$route.path.indexOf(path) === 0);
      if (res) {
        return true;
      }
      return false;
    },
    async fetchCategories() {
      try {
        const res = await axios.get('/categories');
        this.categories = res.data.data;
      } catch (error) {
        console.log(error);
      }
    },
    logout() {
      Dialog.confirm({
        title: 'Are you sure to log out?',
        cancelButtonText: 'Cancel',
        confirmButtonText: 'Sure',
      })
        .then(() => {
          this.$auth.logout({
            redirect: '/',
          });
          Toast.success('Logged out!');
        })
        .catch(() => {});
    },
  },
  mounted() {
    this.fetchCategories();
  },
};
</script>
<style scoped>
.header__top__right__auth {
  margin-left: 5px;
  margin-right: 10px;
}
/* .header__top {
  background: rgb(216, 210, 210);
} */
</style>

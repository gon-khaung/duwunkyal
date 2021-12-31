<template>
    <div>
        <!-- Categories Section Begin -->
        <section class="categories">
            <div class="container">
                <div class="row">
                    <div class="categories__slider owl-carousel">
                        <div
                            class="col-lg-3"
                            v-for="(category, index) in categories"
                            :key="index"
                        >
                            <div
                                class="categories__item set-bg"
                                :style="`background-image: url(${category.image})`"
                            >
                                <h5>
                                    <a href="#">{{ category.name }}</a>
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Categories Section End -->

        <!-- Featured Section Begin -->
        <section class="featured spad">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title">
                            <h2>Featured Product</h2>
                        </div>
                        <div class="featured__controls">
                            <ul>
                                <li
                                    :class="index == 0 ? 'active' : ''"
                                    data-filter="*"
                                    v-for="(cat, index) in featuredCategories"
                                    :key="index"
                                    @click="changeCategoryProducts(index)"
                                >
                                    {{ cat.name }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row featured__filter">
                    <div
                        class="
                            col-lg-3 col-md-4 col-sm-6
                            mix
                            oranges
                            fresh-meat
                        "
                        v-for="(product, index) in products"
                        :key="index"
                    >
                        <div class="featured__item">
                            <div
                                class="featured__item__pic set-bg"
                                :style="`background-image: url(https://thetkhine.com/wp-content/uploads/2021/07/Sunset1-768x512.jpeg)`"
                            >
                                <ul class="featured__item__pic__hover">
                                    <li>
                                        <a
                                            href="#"
                                            @click="addToCart(product.id)"
                                            ><i class="fa fa-shopping-cart"></i
                                        ></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="featured__item__text">
                                <h6>
                                    <a href="#">{{ product.name }}</a>
                                </h6>
                                <h5>${{ product.price }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Featured Section End -->

        <!-- Banner Begin -->
        <div class="banner">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="banner__pic">
                            <img src="assets/img/banner/banner-1.jpg" alt="" />
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="banner__pic">
                            <img src="assets/img/banner/banner-2.jpg" alt="" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Banner End -->
    </div>
</template>
<script>
import { Toast } from 'vant';

export default {
  data() {
    return {
      products: [],
      categories: [],
      featuredCategories: [],
    };
  },
  methods: {
    addToCart(id) {
      let products = this.products.filter((product) => product.id === id);
      const filterProducts = this.$store.state.cart.filter(
        (cart) => cart.id === id,
      );
      if (filterProducts.length > 0) return;

      products = [...this.$store.state.cart, ...products];

      this.$store.commit('setCart', products);

      Toast.success('Added To Cart');

      console.log(this.$store.state.cart);
    },
    async fetchCategories() {
      try {
        const res = await axios.get('/categories');
        this.categories = res.data.data;
      } catch (error) {
        console.log(error);
      }
    },
    async fetchFeaturedCategories() {
      try {
        const res = await axios.get('/categories', {
          params: {
            is_featured: true,
          },
        });
        this.featuredCategories = res.data.data;
        this.products = this.featuredCategories[0].products;
      } catch (error) {
        console.log(error);
      }
    },
    changeCategoryProducts(id) {
      this.products = this.featuredCategories[id].products;
    },
  },
  mounted() {
    this.fetchCategories();
    this.fetchFeaturedCategories();
  },
};
</script>

<template>
    <div>
        <NavBar />
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
                    <Product
                        :data="product"
                        v-for="(product, index) in products"
                        :key="index"
                    />
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
import Product from './components/Product.vue';

export default {
  components: { Product },
  data() {
    return {
      products: [],
      categories: [],
      featuredCategories: [],
      test: `<div class="col-lg-3">
                            <div
                                class="categories__item set-bg"
                                :style=""
                            >
                                <h5>
                                    <a href="#">Hello</a>
                                </h5>
                            </div>
                        </div>`,
    };
  },
  methods: {
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

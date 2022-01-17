<template>
    <div>
        <NavBar />
        <!-- Categories Section Begin -->
        <section class="categories">
            <div class="container">
                <Slider :categories="categories" />
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
                                    :class="
                                        index == categoryActive ? 'active' : ''
                                    "
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
import Slider from './components/Slider.vue';

export default {
  components: { Product, Slider },
  data() {
    return {
      categoryActive: 0,
      products: [],
      categories: [],
      featuredCategories: [],
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
      this.categoryActive = id;
    },
  },
  mounted() {
    this.fetchCategories();
    this.fetchFeaturedCategories();
  },
};
</script>

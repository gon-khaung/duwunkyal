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
                                :data-setbg="category.image"
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
                                <li class="active" data-filter="*">All</li>
                                <li data-filter=".oranges">Oranges</li>
                                <li data-filter=".fresh-meat">Fresh Meat</li>
                                <li data-filter=".vegetables">Vegetables</li>
                                <li data-filter=".fastfood">Fastfood</li>
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
                                data-setbg="img/featured/feature-1.jpg"
                            >
                                <ul class="featured__item__pic__hover">
                                    <li>
                                        <a href="#"
                                            ><i class="fa fa-shopping-cart"></i
                                        ></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="featured__item__text">
                                <h6><a href="#">Crab Pool Security</a></h6>
                                <h5>$30.00</h5>
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
                            <img src="img/banner/banner-1.jpg" alt="" />
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="banner__pic">
                            <img src="img/banner/banner-2.jpg" alt="" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Banner End -->
    </div>
</template>
<script>
export default {
  data() {
    return {
      products: [
        {
          test: 'test',
        },
      ],
      categories: [],
    };
  },
  methods: {
    async fetchProducts() {
      try {
        const res = await axios.get('/products');
        this.products = res.data.data;
      } catch (error) {
        console.log(error);
      }
    },
    async fetchCategories() {
      try {
        const res = await axios.get('/categories');
        this.categories = res.data.data;
      } catch (error) {
        console.log(error);
      }
    },
  },
  mounted() {
    this.fetchProducts();
    this.fetchCategories();
  },
};
</script>

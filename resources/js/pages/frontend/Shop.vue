<template>
  <div>
    <NavBar :isNone="true" :isSecondHead="false" />
    <!-- Breadcrumb Section Begin -->
    <Breadcrumb :text="'Shop'" />
    <!-- Breadcrumb Section End -->

    <!-- Product Section Begin -->
    <section class="product spad">
      <div class="container">
        <div class="row">
          <div class="col-lg-3 col-md-5">
            <div class="sidebar">
              <div class="sidebar__item">
                <h2>Categories</h2>
                <ul>
                  <li v-for="(cat, index) in categories" :key="index">
                    <a
                      href="#"
                      @click.prevent="changeCategory(cat.id)"
                      :class="
                        parseInt(category, 10) === cat.id
                          ? 'category-active'
                          : ''
                      "
                      >{{ cat.name }}</a
                    >
                  </li>
                </ul>
              </div>
              <div class="sidebar__item">
                <div class="latest-product__text">
                  <h2>Latest Products</h2>
                  <div class="latest-product__slider owl-carousel">
                    <div class="latest-prdouct__slider__item">
                      <a
                        href="#"
                        class="latest-product__item"
                        v-for="(product, index) in latestProducts.slice(0, 3)"
                        :key="index"
                        @click="$router.push(`/product/${product.id}`)"
                      >
                        <div class="latest-product__item__pic">
                          <img src="img/latest-product/lp-1.jpg" alt="" />
                        </div>
                        <div class="latest-product__item__text">
                          <h6>{{ product.name }}</h6>
                          <span>{{ product.price }}</span>
                        </div>
                      </a>
                    </div>
                    <div class="latest-prdouct__slider__item">
                      <a
                        href="#"
                        class="latest-product__item"
                        v-for="(product, index) in latestProducts.slice(3)"
                        :key="index"
                      >
                        <div class="latest-product__item__pic">
                          <img src="img/latest-product/lp-1.jpg" alt="" />
                        </div>
                        <div class="latest-product__item__text">
                          <h6>{{ product.name }}</h6>
                          <span>{{ product.price }}</span>
                        </div>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-9 col-md-7">
            <div class="filter__item">
              <div class="row">
                <div class="col-lg-4 col-md-5">
                  <div class="filter__sort">
                    <van-popover
                      v-model="showPopover"
                      trigger="click"
                      :actions="actions"
                      @select="onSelect"
                      style="cursor: pointer"
                    >
                      <template #reference>
                        <span
                          >Sort By Price <i class="fas fa-arrow-down"></i
                        ></span>
                      </template>
                    </van-popover>
                  </div>
                </div>
                <div class="col-lg-4 col-md-4">
                  <div class="filter__found">
                    <h6>
                      <span>{{ totalProducts }}</span>
                      Products found
                    </h6>
                  </div>
                </div>
                <div class="col-lg-4 col-md-4">
                  <div class="filter__found">
                    <h6 style="cursor: pointer" @click="allProducts">
                      <span style="color: #7fad39"><u> All Products </u></span>
                    </h6>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div
                class="col-lg-4 col-md-6 col-sm-6"
                v-for="(product, index) in products"
                :key="index"
              >
                <div class="product__item">
                  <div
                    class="product__item__pic set-bg"
                    :style="`background-image: url(${product.image})`"
                  >
                    <ul class="product__item__pic__hover">
                      <li>
                        <a
                          href="#"
                          @click="$router.push(`/product/${product.id}`)"
                          ><i class="fas fa-eye"></i
                        ></a>
                      </li>
                    </ul>
                  </div>
                  <div class="product__item__text">
                    <h6>
                      <a href="#">{{ product.name }}</a>
                    </h6>
                    <h5>{{ product.price }} MMK</h5>
                  </div>
                </div>
              </div>
            </div>
            <div class="product__pagination">
              <a href="#" v-if="page !== 1" @click.prevent="decPage()"
                ><i class="fa fa-long-arrow-left"></i
              ></a>
              <a
                href="#"
                v-for="(pagi, index) in total"
                :key="index"
                @click.prevent="paginate(pagi)"
                :class="pagi === page ? 'pagi-active' : ''"
                >{{ pagi }}</a
              >
              <a href="#" v-if="page < total" @click.prevent="incPage()"
                ><i class="fa fa-long-arrow-right"></i
              ></a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Product Section End -->
  </div>
</template>
<script>
import Breadcrumb from './components/Breadcrumb.vue';

export default {
  props: ['id'],
  data() {
    return {
      categories: [],
      products: [],
      latestProducts: [],
      category: this.id ? this.id : null,
      showPopover: false,
      actions: [{ text: 'Desc' }, { text: 'Asc' }],
      page: 1,
      total: null,
      type: 'asc',
      totalProducts: null,
    };
  },
  watch: {
    page() {
      this.fetchProducts();
    },
    category() {
      this.fetchProducts();
    },
  },
  components: { Breadcrumb },
  methods: {
    allProducts() {
      this.category = null;
    },
    incPage() {
      this.page += 1;
    },
    decPage() {
      this.page -= 1;
    },
    paginate(no) {
      this.page = no;
    },
    changeCategory(id) {
      this.category = id;
    },
    onSelect(action) {
      if (action.text === 'Desc') this.type = 'desc';
      else this.type = 'asc';
      this.fetchProducts();
    },

    async fetchCategories() {
      try {
        const res = await axios.get('/categories');
        this.categories = res.data.data;
      } catch (error) {
        console.log(error);
      }
    },
    async fetchLatestProducts() {
      try {
        const res = await axios.get('/products', {
          params: {
            latest: true,
          },
        });
        this.latestProducts = res.data.data;
      } catch (error) {
        console.log(error);
      }
    },
    async fetchProducts() {
      try {
        const res = await axios.get('/shop_products', {
          params: {
            category_id: this.category,
            type: this.type,
            page: this.page,
            limit: 9,
          },
        });
        this.products = res.data.data;
        this.total = Math.ceil(res.data.total / 9);
        this.totalProducts = res.data.total;
        console.log(this.total);
      } catch (error) {
        console.log(error);
      }
    },
    async searchProducts(search) {
      try {
        const res = await axios.get('/products', {
          params: {
            search,
          },
        });
        this.products = res.data.data;
      } catch (error) {
        console.log(error);
      }
    },
  },
  mounted() {
    this.fetchCategories();
    this.fetchLatestProducts();
    if (this.$route.query.search) {
      this.searchProducts(this.$route.query.search);
    } else {
      this.fetchProducts();
    }
  },
};
</script>
<style scoped>
.pagi-active {
  background: #7fad39;
  color: white;
  border: none;
}
.category-active {
  color: #7fad39;
  border-left: 5px solid #7fad39;
  padding-left: 10px;
}
.custom-button {
  color: white;
  background: #7fad39;
  border-radius: 5px;
  padding: 0px 20px;
  border: 1px solid #7fad39;
}
</style>

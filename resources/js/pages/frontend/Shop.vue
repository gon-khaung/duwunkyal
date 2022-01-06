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
                                <h4>Department</h4>
                                <ul>
                                    <li
                                        v-for="(category, index) in categories"
                                        :key="index"
                                    >
                                        <a href="#">{{ category.name }}</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="sidebar__item">
                                <div class="latest-product__text">
                                    <h4>Latest Products</h4>
                                    <div
                                        class="
                                            latest-product__slider
                                            owl-carousel
                                        "
                                    >
                                        <div
                                            class="latest-prdouct__slider__item"
                                        >
                                            <a
                                                href="#"
                                                class="latest-product__item"
                                                v-for="(
                                                    product, index
                                                ) in latestProducts.slice(0, 3)"
                                                :key="index"
                                            >
                                                <div
                                                    class="
                                                        latest-product__item__pic
                                                    "
                                                >
                                                    <img
                                                        src="img/latest-product/lp-1.jpg"
                                                        alt=""
                                                    />
                                                </div>
                                                <div
                                                    class="
                                                        latest-product__item__text
                                                    "
                                                >
                                                    <h6>{{ product.name }}</h6>
                                                    <span>{{
                                                        product.price
                                                    }}</span>
                                                </div>
                                            </a>
                                        </div>
                                        <div
                                            class="latest-prdouct__slider__item"
                                        >
                                            <a
                                                href="#"
                                                class="latest-product__item"
                                                v-for="(
                                                    product, index
                                                ) in latestProducts.slice(3)"
                                                :key="index"
                                            >
                                                <div
                                                    class="
                                                        latest-product__item__pic
                                                    "
                                                >
                                                    <img
                                                        src="img/latest-product/lp-1.jpg"
                                                        alt=""
                                                    />
                                                </div>
                                                <div
                                                    class="
                                                        latest-product__item__text
                                                    "
                                                >
                                                    <h6>{{ product.name }}</h6>
                                                    <span>{{
                                                        product.price
                                                    }}</span>
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
                                        >
                                            <template #reference>
                                                <span
                                                    >Sort By Price
                                                    <i
                                                        class="
                                                            fas
                                                            fa-arrow-down
                                                        "
                                                    ></i
                                                ></span>
                                            </template>
                                        </van-popover>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4">
                                    <div class="filter__found">
                                        <h6>
                                            <span>{{ products.length }}</span>
                                            Products found
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
                                        :data-setbg="product.image"
                                    >
                                        <ul class="product__item__pic__hover">
                                            <ul
                                                class="
                                                    featured__item__pic__hover
                                                "
                                            >
                                                <li>
                                                    <a
                                                        href="#"
                                                        @click="
                                                            $router.push(
                                                                `/product/${product.id}`
                                                            )
                                                        "
                                                        ><i
                                                            class="fas fa-eye"
                                                        ></i
                                                    ></a>
                                                </li>
                                            </ul>
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
                            <a href="#">1</a>
                            <a href="#">2</a>
                            <a href="#">3</a>
                            <a href="#"
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
  data() {
    return {
      categories: [],
      products: [],
      latestProducts: [],
      category: null,
      showPopover: false,
      actions: [{ text: 'Desc' }, { text: 'Asc' }],
      page: 1,
      type: 'asc',
    };
  },
  components: { Breadcrumb },
  methods: {
    onSelect(action) {
      if (action.text === 'Desc') this.type = 'desc';
      else this.type = 'asc';
      this.fetchProducts();
    },
    textCapitalize(text) {
      let newText = text;
      newText = newText.charAt(0).toUpperCase() + newText.slice(1);
      return newText;
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
      } catch (error) {
        console.log(error);
      }
    },
  },
  mounted() {
    this.fetchCategories();
    this.fetchLatestProducts();
    this.fetchProducts();
  },
};
</script>

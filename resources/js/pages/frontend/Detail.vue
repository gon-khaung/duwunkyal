<template>
    <div>
        <!-- Breadcrumb Section Begin -->
        <section
            class="breadcrumb-section set-bg"
            data-setbg="img/breadcrumb.jpg"
        >
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <div class="breadcrumb__text">
                            <h2>Vegetable’s Package</h2>
                            <div class="breadcrumb__option">
                                <a href="./index.html">Home</a>
                                <a href="./index.html">Vegetables</a>
                                <span>Vegetable’s Package</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Breadcrumb Section End -->

        <!-- Product Details Section Begin -->
        <section class="product-details spad">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="product__details__pic">
                            <div class="product__details__pic__item">
                                <img
                                    class="product__details__pic__item--large"
                                    src="https://thetkhine.com/wp-content/uploads/2021/07/Sunset1-768x512.jpeg"
                                    alt=""
                                />
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="product__details__text">
                            <h3>Vetgetable’s Package</h3>
                            <div class="product__details__price">
                                ${{ product.price }}
                            </div>
                            <p>
                                {{ product.description }}
                            </p>
                            <div class="theme-light preload">
                                <div class="row">
                                    <div
                                        class="
                                            input input--radio input--primary
                                        "
                                        style="margin-right: 20px"
                                        v-for="(color, index) in product.colors"
                                        :key="index"
                                    >
                                        <label>
                                            <input
                                                type="radio"
                                                name="radio--light-primary"
                                                checked
                                            />
                                            <span class="input__box"></span>
                                            <span>{{ color }}</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="theme-light preload">
                                <div class="row">
                                    <div
                                        class="
                                            input input--radio input--secondary
                                        "
                                        style="margin-right: 20px"
                                        v-for="(size, index) in product.sizes"
                                        :key="index"
                                    >
                                        <label>
                                            <input
                                                type="radio"
                                                name="radio--light-secondary"
                                                checked
                                            />
                                            <span class="input__box"></span>
                                            <span>{{ size }}</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="product__details__quantity">
                                    <div class="quantity">
                                        <div class="pro-qty">
                                            <input type="text" value="1" />
                                        </div>
                                    </div>
                                </div>
                                <a
                                    href="#"
                                    @click.prevent="addToCart(product.id)"
                                    class="primary-btn"
                                    v-if="!isCart"
                                    >ADD TO CART</a
                                >
                                <a
                                    href="#"
                                    @click.prevent="removeFromCart(product.id)"
                                    class="primary-btn"
                                    v-else
                                    >REMOVE FROM CART</a
                                >
                            </div>

                            <ul>
                                <li>
                                    <b>Availability</b>
                                    <span
                                        v-if="product.is_instock"
                                        class="text-success"
                                        >In Stock</span
                                    >
                                    <span v-else class="text-danger"
                                        >Out of Stock</span
                                    >
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Product Details Section End -->

        <!-- Related Product Section Begin -->
        <section class="related-product">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title related__product__title">
                            <h2>Related Product</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="product__item">
                            <div
                                class="product__item__pic set-bg"
                                data-setbg="img/product/product-1.jpg"
                            >
                                <ul class="product__item__pic__hover">
                                    <li>
                                        <a href="#"
                                            ><i class="fa fa-heart"></i
                                        ></a>
                                    </li>
                                    <li>
                                        <a href="#"
                                            ><i class="fa fa-retweet"></i
                                        ></a>
                                    </li>
                                    <li>
                                        <a href="#"
                                            ><i class="fa fa-shopping-cart"></i
                                        ></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <h6><a href="#">Crab Pool Security</a></h6>
                                <h5>$30.00</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="product__item">
                            <div
                                class="product__item__pic set-bg"
                                data-setbg="img/product/product-2.jpg"
                            >
                                <ul class="product__item__pic__hover">
                                    <li>
                                        <a href="#"
                                            ><i class="fa fa-heart"></i
                                        ></a>
                                    </li>
                                    <li>
                                        <a href="#"
                                            ><i class="fa fa-retweet"></i
                                        ></a>
                                    </li>
                                    <li>
                                        <a href="#"
                                            ><i class="fa fa-shopping-cart"></i
                                        ></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <h6><a href="#">Crab Pool Security</a></h6>
                                <h5>$30.00</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="product__item">
                            <div
                                class="product__item__pic set-bg"
                                data-setbg="img/product/product-3.jpg"
                            >
                                <ul class="product__item__pic__hover">
                                    <li>
                                        <a href="#"
                                            ><i class="fa fa-heart"></i
                                        ></a>
                                    </li>
                                    <li>
                                        <a href="#"
                                            ><i class="fa fa-retweet"></i
                                        ></a>
                                    </li>
                                    <li>
                                        <a href="#"
                                            ><i class="fa fa-shopping-cart"></i
                                        ></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <h6><a href="#">Crab Pool Security</a></h6>
                                <h5>$30.00</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="product__item">
                            <div
                                class="product__item__pic set-bg"
                                data-setbg="img/product/product-7.jpg"
                            >
                                <ul class="product__item__pic__hover">
                                    <li>
                                        <a href="#"
                                            ><i class="fa fa-heart"></i
                                        ></a>
                                    </li>
                                    <li>
                                        <a href="#"
                                            ><i class="fa fa-retweet"></i
                                        ></a>
                                    </li>
                                    <li>
                                        <a href="#"
                                            ><i class="fa fa-shopping-cart"></i
                                        ></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <h6><a href="#">Crab Pool Security</a></h6>
                                <h5>$30.00</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Related Product Section End -->
    </div>
</template>

<script>
import { Toast } from 'vant';

export default {
  props: ['id'],
  data() {
    return {
      product: [],
      isCart: false,
      size: [],
      color: [],
    };
  },
  methods: {
    checkIsProductIsInLocalstorage(id) {
      const filterProducts = this.getLocalstorage('cartProducts').filter(
        (cart) => cart.id === parseInt(id, 10),
      );
      if (filterProducts.length > 0) {
        this.isCart = true;
        return true;
      }
      console.log('false');
      this.isCart = false;
      return false;
    },
    addToCart(id) {
      const products = [
        ...this.getLocalstorage('cartProducts'),
        this.product,
      ];

      this.setLocalstorage('cartProducts', products);

      this.$store.commit('setCart', products);

      Toast.success('Added!');

      this.isCart = true;
    },
    removeFromCart(id) {
      const products = this.getLocalstorage('cartProducts').filter(
        (cart) => cart.id !== id,
      );

      this.setLocalstorage('cartProducts', products);

      this.$store.commit('setCart', products);

      Toast.success('Removed!');

      this.isCart = false;
    },
    setLocalstorage(name, data) {
      localStorage.setItem(name, JSON.stringify(data));
    },
    getLocalstorage(name) {
      return JSON.parse(localStorage.getItem(name));
    },
    async fetchProduct() {
      try {
        const res = await axios.get(`products/${this.id}`);
        this.product = res.data.data;
      } catch (error) {
        console.log(error);
      }
    },
  },
  mounted() {
    this.fetchProduct();
    this.checkIsProductIsInLocalstorage(this.id);
  },
};
</script>

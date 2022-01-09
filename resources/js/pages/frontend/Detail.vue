<template>
    <div>
        <NavBar :isSecondHead="false" :isNone="true" />
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
                            <h3>{{ product.name }}</h3>
                            <div class="product__details__price">
                                {{ product.price }} MMK
                            </div>
                            <p class="mb-3">
                                {{ product.description }}
                            </p>
                            <div class="theme-light preload">
                                <div>
                                    <div
                                        class="
                                            input input--radio input--primary
                                        "
                                        style="margin-right: 20px"
                                        v-for="(
                                            radioColor, index
                                        ) in product.color_names"
                                        :key="index"
                                    >
                                        <label>
                                            <input
                                                type="radio"
                                                name="radio--light-primary"
                                                v-model="color"
                                                :value="radioColor"
                                            />
                                            <span class="input__box"></span>
                                            <span>{{
                                                textCapitalize(radioColor)
                                            }}</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="theme-light preload mt-2">
                                <div>
                                    <div
                                        class="
                                            input input--radio input--secondary
                                        "
                                        style="margin-right: 20px"
                                        v-for="(
                                            radioSize, index
                                        ) in product.size_names"
                                        :key="index"
                                    >
                                        <label>
                                            <input
                                                type="radio"
                                                name="radio--light-secondary"
                                                v-model="size"
                                                :value="radioSize"
                                            />
                                            <span class="input__box"></span>
                                            <span>{{ radioSize }}</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex mt-3">
                                <div class="quantity mr-3">
                                    <div class="plus" @click="lossQty">-</div>
                                    <input
                                        type="text"
                                        value="1"
                                        v-model="quantity"
                                    />
                                    <div class="minus" @click="addQty">+</div>
                                </div>
                                <button
                                    @click.prevent="addToCart(product.id)"
                                    class="cart-btn"
                                    v-if="!isCart"
                                >
                                    ADD TO CART
                                </button>
                                <button
                                    @click.prevent="removeFromCart(product.id)"
                                    class="cart-btn"
                                    v-else
                                >
                                    REMOVE FROM CART
                                </button>
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
                    <Product
                        :data="product"
                        v-for="(product, index) in relatedProducts"
                        :key="index"
                        @test="refreshPage"
                    />
                </div>
            </div>
        </section>
        <!-- Related Product Section End -->
    </div>
</template>

<script>
import { Toast } from 'vant';
import Product from './components/Product.vue';

export default {
  props: ['id'],
  components: { Product },
  data() {
    return {
      product: {},
      isCart: false,
      size: null,
      color: null,
      relatedProducts: [],
      quantity: 1,
    };
  },
  methods: {
    addQty() {
      this.quantity += 1;
    },
    lossQty() {
      if (this.quantity > 1) this.quantity -= 1;
    },
    refreshPage(value) {
      this.fetchProduct(value);
      this.checkIsProductIsInLocalstorage(value);
    },
    textCapitalize(text) {
      let newText = text;
      newText = newText.charAt(0).toUpperCase() + newText.slice(1);
      return newText;
    },
    checkIsProductIsInLocalstorage(id) {
      const filterProducts = this.getLocalstorage('cartProducts').filter(
        (cart) => cart.id === parseInt(id, 10),
      );
      if (filterProducts.length > 0) {
        this.isCart = true;
        return true;
      }
      this.isCart = false;
      return false;
    },
    addToCart(id) {
      const newProduct = {
        name: this.product.name,
        id: this.product.id,
        quantity: this.quantity,
        size: this.size,
        color: this.color,
        price: this.product.price,
      };
      const products = [
        ...this.getLocalstorage('cartProducts'),
        newProduct,
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
    async fetchProduct(id) {
      try {
        const res = await axios.get(`products/${id}`);
        this.product = res.data.data;
        console.log(this.product);
        this.color = this.product.color_names[0];
        this.size = this.product.size_names[0];
        this.fetchRelatedProducts(this.product.category_id);
      } catch (error) {
        console.log(error);
      }
    },
    async fetchRelatedProducts(id) {
      try {
        const res = await axios.get('products', {
          params: {
            category_id: id,
          },
        });
        this.relatedProducts = res.data.data;
      } catch (error) {
        console.log(error);
      }
    },
  },
  mounted() {
    this.fetchProduct(this.id);
    this.checkIsProductIsInLocalstorage(this.id);
  },
};
</script>
<style scoped>
.plus {
    width: 35px;
    height: 35px;
    border: 1px solid #7fad39;
    color: #7fad39;
    text-align: center;
    vertical-align: middle;
    line-height: 35px;
    font-size: 30px;
    cursor: pointer;
}
.minus {
    width: 35px;
    height: 35px;
    border: 1px solid #7fad39;
    color: #7fad39;
    text-align: center;
    vertical-align: middle;
    line-height: 35px;
    font-size: 20px;
    cursor: pointer;
}
.quantity input {
    width: 60px;
    height: 35px;
    border-left: none;
    border-right: none;
    border: none;
    background: transparent;
    text-align: center;
}
.quantity {
    display: flex;
}
.cart-btn {
    height: 35px;
    line-height: 30px;
    font-size: 15px;
    color: white;
    background: #7fad39;
    border: none;
    border-radius: 5px;
    padding: 0px 20px;
}
.cart-btn:active {
    border: none;
}
</style>

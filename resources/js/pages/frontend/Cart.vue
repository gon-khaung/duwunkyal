<template>
    <div>
        <!-- Shoping Cart Section Begin -->
        <section class="shoping-cart spad">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="shoping__cart__table">
                            <table>
                                <thead>
                                    <tr>
                                        <th class="shoping__product">
                                            Products
                                        </th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        v-for="(product, index) in $store.state
                                            .cart"
                                        :key="index"
                                    >
                                        <td class="shoping__cart__item">
                                            <img
                                                src="img/cart/cart-1.jpg"
                                                alt=""
                                            />
                                            <h5>{{ product.name }}</h5>
                                        </td>
                                        <td class="shoping__cart__price">
                                            {{ product.price }}
                                        </td>
                                        <td class="shoping__cart__quantity">
                                            <div class="quantity">
                                                <div class="pro-qty">
                                                    <input
                                                        type="text"
                                                        value="1"
                                                    />
                                                </div>
                                            </div>
                                        </td>
                                        <td class="shoping__cart__total">
                                            {{ product.total }}
                                        </td>
                                        <td class="shoping__cart__item__close">
                                            <span
                                                class="icon_close"
                                                @click="
                                                    removeFromCart(product.id)
                                                "
                                            ></span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="shoping__cart__btns">
                            <a
                                href="#"
                                class="primary-btn"
                                @click="$router.push('checkout')"
                                >CONTINUE SHOPPING</a
                            >
                            <a
                                href="#"
                                class="primary-btn cart-btn cart-btn-right"
                                ><span class="icon_loading"></span> Upadate
                                Cart</a
                            >
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Shoping Cart Section End -->
    </div>
</template>
<script>
import { Toast } from 'vant';

export default {
  methods: {
    removeFromCart(id) {
      const products = this.getLocalstorage('cartProducts').filter(
        (cart) => cart.id !== id,
      );

      this.setLocalstorage('cartProducts', products);

      this.$store.commit('setCart', products);

      Toast.success('Removed Item');
    },
    getLocalstorage(name) {
      return JSON.parse(localStorage.getItem(name));
    },
    setLocalstorage(name, data) {
      localStorage.setItem(name, JSON.stringify(data));
    },
  },
};
</script>

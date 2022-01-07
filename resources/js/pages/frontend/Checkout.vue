<template>
    <div>
        <NavBar />
        <!-- Checkout Section Begin -->
        <section class="checkout spad">
            <div class="container">
                <div class="checkout__form">
                    <h4>Billing Details</h4>
                    <form action="#">
                        <div class="row">
                            <div class="col-lg-8 col-md-6">
                                <div class="checkout__input">
                                    <p>Phone<span>*</span></p>
                                    <input type="text" v-model="phone" />
                                    <p class="text-danger" v-if="errors.phone">
                                        {{ errors.phone }}
                                    </p>
                                </div>
                                <div class="checkout__input">
                                    <p>Address<span>*</span></p>
                                    <input type="text" v-model="address" />
                                    <p
                                        class="text-danger"
                                        v-if="errors.address"
                                    >
                                        {{ errors.address }}
                                    </p>
                                </div>
                                <div class="checkout__input">
                                    <p>Order notes<span> (Optional)</span></p>
                                    <input
                                        type="text"
                                        placeholder="Notes about your order, e.g. special notes for delivery."
                                        v-model="note"
                                    />
                                </div>
                                <p>
                                    Create an account by entering the
                                    information below. If you are a returning
                                    customer please login at the top of the page
                                </p>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="checkout__order">
                                    <h4>Your Order</h4>
                                    <div class="checkout__order__products">
                                        Products <span>Total</span>
                                    </div>
                                    <ul>
                                        <li
                                            v-for="(order, index) in $store
                                                .state.cart"
                                            :key="index"
                                        >
                                            {{ order.name }}
                                            <span
                                                >{{ order.quantity }} x
                                                {{ order.price }} MMK
                                            </span>
                                        </li>
                                    </ul>
                                    <div class="checkout__order__subtotal">
                                        Subtotal
                                        <span>{{ getTotal() }} MMK</span>
                                    </div>
                                    <div class="checkout__order__total">
                                        Total <span>{{ getTotal() }} MMK</span>
                                    </div>
                                    <button
                                        type="button"
                                        @click="finalOrder"
                                        class="site-btn"
                                    >
                                        PLACE ORDER
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <!-- Checkout Section End -->
    </div>
</template>
<script>
export default {
  data() {
    return {
      phone: null,
      address: null,
      note: null,
      errors: {
        phone: null,
        address: null,
      },
    };
  },
  methods: {
    getTotal() {
      let total = 0;
      for (let i = 0; i < this.$store.state.cart.length; i += 1) {
        total
                    += parseInt(this.$store.state.cart[i].price, 10)
                    * this.$store.state.cart[i].quantity;
      }
      return total;
    },
    async finalOrder() {
      if (!this.phone) {
        this.errors.phone = 'Phone Number is required!';
        return false;
      }
      if (!this.address) {
        this.errors.phone = null;
        this.errors.address = 'Address is required!';
        return false;
      }
      try {
        const res = await axios.post('orders', {
          phone: this.phone,
          address: this.address,
          note: this.note,
          total: this.getTotal(),
          products: this.$store.state.cart,
        });
        this.phone = null;
        this.address = null;
        this.note = null;
        this.$store.commit('setCart', []);
      } catch (error) {
        console.log(error);
      }
      return true;
    },
  },
};
</script>

<template>
    <div>
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
                                    <input type="text" />
                                </div>
                                <div class="checkout__input">
                                    <p>Address<span>*</span></p>
                                    <input type="text" />
                                </div>
                                <div class="checkout__input">
                                    <p>Order notes<span>*</span></p>
                                    <input
                                        type="text"
                                        placeholder="Notes about your order, e.g. special notes for delivery."
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
                                            v-for="(product, index) in $store
                                                .state.cart"
                                            :key="index"
                                        >
                                            {{ product.name }}
                                            <span
                                                >{{
                                                    product.price *
                                                    product.quantity
                                                }}
                                                MMK</span
                                            >
                                        </li>
                                    </ul>
                                    <div class="checkout__order__total">
                                        Total
                                        <span
                                            >{{
                                                calculateTotal(
                                                    $store.state.cart
                                                )
                                            }}
                                            MMK</span
                                        >
                                    </div>
                                    <button type="submit" class="site-btn">
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
  methods: {
    calculateTotal(data) {
      let total = 0;
      for (let i = 0; i < data.length; i += 1) {
        total += parseInt(data[i].price, 10);
      }
      return total;
    },
  },
};
</script>

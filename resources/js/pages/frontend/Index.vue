<template>
    <div>
        <NavBar />
        <router-view class="middle-container"> </router-view>
        <Footer />
        <div class="social-contacts" id="social-contacts">
            <div
                data-toggle="tooltip"
                data-placement="top"
                title="Facebook Page"
            >
                <a href="https://m.me/star2d3d">
                    <img src="/build/assets/img/theme/facebook.png" alt="" />
                </a>
            </div>
            <div data-toggle="tooltip" data-placement="top" title="Viber">
                <a href="viber://contact?number=%2B959775807000">
                    <img src="/build/assets/img/theme/viber.png" alt="" />
                </a>
            </div>
            <div data-toggle="tooltip" data-placement="top" title="Whatsapp">
                <a href="https://wa.me/+959775807000">
                    <img src="/build/assets/img/theme/whatsapp.png" alt="" />
                </a>
            </div>
            <div
                style="position: relative"
                class="cart-container"
                v-if="$route.path.includes('2d') || $route.path.includes('3d')"
                data-toggle="modal"
                data-target="#mobile-voucher"
            >
                <div>
                    <i class="ni ni-cart mb-2"></i>
                </div>
                <span
                    class="
                        badge badge-md badge-circle badge-floating badge-danger
                        border-white
                        cart-number
                    "
                    v-if="$route.path.includes('2d')"
                    >{{ this.$store.state.twod_slip_data.length }}</span
                >
                <span
                    class="
                        badge badge-md badge-circle badge-floating badge-danger
                        border-white
                        cart-number
                    "
                    v-else-if="$route.path.includes('3d')"
                    >{{ this.$store.state.threed_slip_data.length }}</span
                >
            </div>
        </div>
    </div>
</template>
<script>
export default {
  mounted() {
    if (this.$auth.check()) {
      this.$store.commit(
        'setAmount',
        parseInt(this.$auth.user().amount, 10),
      );
    }
  },
};
</script>
<style scoped>
.cart-container {
    visibility: hidden;
}
.cart-number {
    position: absolute;
    top: -3px;
    left: -3px;
    text-align: center;
}
.middle-container {
    min-height: 75vh;
}
@media (max-width: 768px) {
    .cart-container {
        visibility: visible;
        font-size: 16px;
    }
    .middle-container {
        min-height: 50vh;
        margin: 0px !important;
    }
}
</style>

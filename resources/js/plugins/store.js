/* eslint-disable */
import Vue from "vue";
import Vuex from "vuex";

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        contact: {},
        cart: localStorage.getItem("cartProducts")
            ? JSON.parse(localStorage.getItem("cartProducts"))
            : 0,
    },
    mutations: {
        setContact(state, value) {
            state.contact = value;
        },
        setCart(state, value) {
            state.cart = value;
        },
    },
});

export default store;

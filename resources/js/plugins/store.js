/* eslint-disable */
import Vue from "vue";
import Vuex from "vuex";

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        contact: {},
    },
    mutations: {
        setContact(state, value) {
            state.contact = value;
        },
    },
});

export default store;

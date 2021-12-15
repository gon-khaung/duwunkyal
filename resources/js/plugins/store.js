/* eslint-disable */
import Vue from "vue";
import Vuex from "vuex";

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        amount: 0.0,
        twod_slip_data: [],
        threed_slip_data: [],
        twod_numbers: [],
        threed_numbers: [],
        language: localStorage.getItem("language")
            ? localStorage.getItem("language")
            : "en",
    },
    mutations: {
        setAmount(state, value) {
            state.amount = value;
        },
        setTwodSlip(state, value) {
            state.twod_slip_data = value;
        },
        setThreedSlip(state, value) {
            state.threed_slip_data = value;
        },
        setTwodnumbers(state, value) {
            state.twod_numbers = value;
        },
        setThreednumbers(state, value) {
            state.threed_numbers = value;
        },
        setLanguage(state, value) {
            state.language = value;
        },
    },
});

export default store;

import Vue from "vue";
import Vuex from "vuex";

import auth from "./modules/auth";
import films from "./modules/films";

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        auth,
        films
    },
});

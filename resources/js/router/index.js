import Vue from "vue";
import Router from "vue-router";
import Cookie from 'js-cookie'
import Home from "../views/Home";
import FilmsIndex from "../views/Films"
import FilmShow from "../views/Films/Show"
import FilmCreate from "../views/Films/Create"


Vue.use(Router);

const ifAuthenticated = (to, from, next) => {
    if (Cookie.get('token')) {
        next()
        return
    }
    next('/')
}

const router = new Router({
    routes: [
        {
            name: "home",
            path: "/",
            component: Home,
        },
        {
            name: 'films',
            path: "/films",
            component: FilmsIndex,
            beforeEnter: ifAuthenticated
        },
        {
            name: "createFilm",
            path: "/films/create",
            component: FilmCreate
        },
        {
            name: "film",
            path: "/films/:slug",
            component: FilmShow
        },

    ],
});

export default router;

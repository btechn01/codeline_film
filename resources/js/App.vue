<template>
    <v-app id="inspire">
        <v-app-bar app>
            <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>

            <v-toolbar-title>Codeline</v-toolbar-title>

            <v-spacer/>
            <LoginRegister v-if="!authenticatedUser.name"/>
            <v-menu v-else
                    bottom
                    min-width="200px"
                    rounded
                    offset-y
            >
                <template v-slot:activator="{ on }">
                    <v-btn
                        icon
                        x-large
                        v-on="on"
                    >
                        <v-avatar
                            size="48"

                        >
                            <v-img src="https://www.alliancerehabmed.com/wp-content/uploads/icon-avatar-default.png"/>
                        </v-avatar>
                    </v-btn>
                </template>
                <v-card>
                    <v-list-item-content class="justify-center">
                        <div class="mx-auto text-center">
                            <h3>
                                {{ authenticatedUser.name }}
                            </h3>
                            <p class="caption mt-1">
                                {{ authenticatedUser.email }}
                            </p>
                            <v-divider class="my-3"></v-divider>
                            <v-btn
                                @click.prevent="logout"
                                depressed
                                rounded
                                text
                            >
                                Disconnect
                            </v-btn>
                        </div>
                    </v-list-item-content>
                </v-card>
            </v-menu>
        </v-app-bar>

        <v-navigation-drawer
            v-model="drawer"
            fixed
            temporary
        >
            <v-list>
                <v-list-item :to="{name: 'films'}">
                    <v-list-item-title>
                        Films
                    </v-list-item-title>
                </v-list-item>
                <v-list-item :to="{name: 'createFilm'}" v-if="authenticatedUser.name">
                    <v-list-item-title>
                        Add movie
                    </v-list-item-title>
                </v-list-item>
            </v-list>
        </v-navigation-drawer>
        <v-slide-x-transition>
            <v-main class="grey lighten-2">
                <v-container>
                    <router-view :key="$route.fullPath"/>
                </v-container>
            </v-main>
        </v-slide-x-transition>
    </v-app>
</template>

<script>
import LoginRegister from "./components/LoginRegister";
import {mapActions, mapGetters} from "vuex";
import {
    AUTHENTICATED_TOKEN,
    AUTHENTICATED_USER,
    FETCH_AUTHENTICATED_USER,
    LOGOUT
} from "./store/constants/access_store";

export default {
    name: "App",
    components: {LoginRegister},
    data: () => ({
        drawer: false,
    }),
    computed: {
        ...mapGetters({
            authenticatedUser: AUTHENTICATED_USER,
            token: AUTHENTICATED_TOKEN
        })
    },
    watch: {
        token: {
            handler(n) {
                if (n && !this.authenticatedUser.name) {
                    this.fetchAuthenticatedUser().then()
                }
            },
            immediate: true
        }
    },
    methods: {
        ...mapActions({
            fetchAuthenticatedUser: FETCH_AUTHENTICATED_USER,
            logout: LOGOUT
        })
    }
};
</script>

<style lang="scss">
@import "../sass/app";
</style>

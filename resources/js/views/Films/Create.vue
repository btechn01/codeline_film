<template>
    <v-layout wrap>
        <v-flex xs12>
            <v-form ref="form" @submit.prevent="submit">
                <v-card>
                    <v-card-title>
                        Create new film
                    </v-card-title>
                    <v-divider/>
                    <v-card-text>
                        <v-layout wrap>
                            <v-flex xs12 pa-1>
                                <v-layout align-center>
                                    Rating
                                    <v-spacer/>
                                    <v-rating
                                        x-large
                                        v-model="film.rating"
                                        color="amber"
                                    ></v-rating>
                                </v-layout>
                            </v-flex>
                            <v-flex xs12 pa-1>
                                <v-file-input
                                    accept="image/*"
                                    label="Photo"
                                    outlined
                                    clear-icon=""
                                    prepend-icon=""
                                    prepend-inner-icon="mdi-attachment"
                                    :rules="rules.required"
                                    v-model="film.photo"
                                />
                            </v-flex>
                            <v-flex xs12 pa-1>
                                <v-text-field label="Name" outlined v-model="film.name" :rules="rules.required"/>
                            </v-flex>
                            <v-flex xs12 pa-1>
                                <v-textarea label="Description" outlined no-resize v-model="film.description"
                                            :rules="rules.required"/>
                            </v-flex>
                            <v-flex xs12 sm6 md4 pa-1>
                                <v-menu
                                    ref="menu"
                                    v-model="menu"
                                    :close-on-content-click="false"
                                    :return-value.sync="film.release_date"
                                    transition="scale-transition"
                                    offset-y
                                    min-width="290px"
                                >
                                    <template v-slot:activator="{ on, attrs }">
                                        <v-text-field
                                            v-model="film.release_date"
                                            label="Picker in menu"
                                            prepend-inner-icon="mdi-calendar"
                                            :rules="rules.required"
                                            readonly
                                            outlined
                                            v-bind="attrs"
                                            v-on="on"
                                        ></v-text-field>
                                    </template>
                                    <v-date-picker
                                        v-model="film.release_date"
                                        no-title
                                        scrollable
                                    >
                                        <v-spacer></v-spacer>
                                        <v-btn
                                            text
                                            color="primary"
                                            @click="menu = false"
                                        >
                                            Cancel
                                        </v-btn>
                                        <v-btn
                                            text
                                            color="primary"
                                            @click="$refs.menu.save(film.release_date)"
                                        >
                                            OK
                                        </v-btn>
                                    </v-date-picker>
                                </v-menu>
                            </v-flex>
                            <v-flex xs12 sm6 md4 pa-1>
                                <v-text-field label="Ticket Price" type="number" v-model="film.ticket_price"
                                              prepend-inner-icon="mdi-currency-usd" :rules="rules.required" outlined/>
                            </v-flex>
                            <v-flex xs12 sm6 md4 pa-1>
                                <v-text-field label="Country" v-model="film.country" :rules="rules.required"
                                              prepend-inner-icon="mdi-map-search"
                                              outlined/>
                            </v-flex>
                            <v-flex xs12 pa-1>
                                <v-autocomplete label="Genres"
                                                multiple
                                                chips
                                                deletable-chips
                                                v-model="film.genres"
                                                :items="genres"
                                                :rules="rules.requiredArray"
                                                prepend-inner-icon="mdi-map-search"
                                                outlined/>
                            </v-flex>
                        </v-layout>
                    </v-card-text>
                    <v-divider/>
                    <v-card-actions>
                        <v-btn type="submit" color="primary" outlined>
                            Save
                        </v-btn>
                        <v-btn type="reset" color="primary" outlined>
                            Reset
                        </v-btn>
                    </v-card-actions>
                </v-card>
            </v-form>
        </v-flex>
    </v-layout>
</template>

<script>
import {AUTHENTICATED_TOKEN, SAVE_FILM} from "../../store/constants/access_store";
import {mapActions, mapGetters} from "vuex";

export default {
    name: "FilmCreate",
    data: () => ({
        film: {
            rating: 1,
            name: null,
            description: null,
            release_date: null,
            ticket_price: null,
            country: null,
            photo: null,
            genres: []
        },
        menu: false,
        rules: {
            required: [v => !!v || 'Required'],
            requiredArray: [
                v => v.length > 0 || 'Required'
            ],
        },
        genres: [
            "Action",
            "Adventure",
            "Comedy",
            "Crime",
            "Drama",
            "Historical",
            "Epics",
            "Horror",
            "Musical",
            "Dance",
            "Science fiction",
            "War",
            "Westerns"
        ]
    }),
    computed: {
        ...mapGetters({
            token: AUTHENTICATED_TOKEN
        })
    },
    watch: {
        token: {
            handler(n) {
                if (!n)
                    this.$router.push({name: 'home'})
            },
            immediate: true
        }
    },
    methods: {
        ...mapActions({
            saveFilm: SAVE_FILM
        }),
        submit() {
            if (this.$refs.form.validate()) {
                const {rating, name, description, release_date, ticket_price, country, photo, genres} = this.film
                let formData = new FormData();
                formData.append("rating", rating)
                formData.append("name", name);
                formData.append("description", description);
                formData.append("release_date", release_date);
                formData.append("ticket_price", ticket_price);
                formData.append("country", country);
                formData.append("photo", photo);
                formData.append("genres", JSON.stringify(genres));
                this.saveFilm(formData).then(() => {
                    this.$refs.form.reset()
                })
            }
        }
    }
}
</script>

<style scoped>

</style>

<template>
    <v-layout wrap>
        <v-flex xs12 sm6 md4>
            <Film :film="film" :show-action="false"/>
        </v-flex>
        <v-flex xs12 sm6 md8 pl-2>
            <Comments v-if="film" :film-id="film.id" :comments="film.comments" />
        </v-flex>
    </v-layout>
</template>

<script>
import {FETCH_FILM, GET_FILM} from "../../store/constants/access_store";
import Film from "../../components/Film";
import {mapGetters} from "vuex";
import Comments from "../../components/Comments";

export default {
    name: "FilmShow",
    components: {Comments, Film},
    computed: {
      ...mapGetters({
          film: GET_FILM
      })
    },
    mounted() {
        this.$store.dispatch(FETCH_FILM, this.$router.currentRoute.params.slug)
    }
}
</script>

<style scoped>

</style>

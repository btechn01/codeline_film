<template>
    <v-layout wrap>
        <template v-for="item in films">
            <v-flex xs12 sm6 md4 pa-1 :key="item.id">
                <Film :film="item"/>
            </v-flex>
        </template>
    </v-layout>
</template>

<script>
import Film from "../../components/Film";
import {mapGetters} from "vuex";
import {FETCH_FILMS, GET_FILMS} from "../../store/constants/access_store";
export default {
    name: "FilmsIndex",
    components: {Film},
    computed: {
        ...mapGetters({
            films: GET_FILMS
        })
    },
    mounted() {
        this.$store.dispatch(FETCH_FILMS)
    }
}
</script>

<style scoped>

</style>

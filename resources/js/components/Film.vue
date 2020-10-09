<template>
    <v-card
        class="mx-auto my-12"
        max-width="374"
    >
        <v-img
            height="250"
            :src="film.photo"
        ></v-img>

        <v-card-title>{{ film.name }}</v-card-title>

        <v-card-text>
            <v-row
                align="center"
                class="mx-0"
            >
                <v-rating
                    :value="film.rating"
                    color="amber"
                    dense
                    readonly
                    size="14"
                ></v-rating>

            </v-row>

            <div class="my-4 subtitle-1">
                ${{ film.ticket_price }} • {{ film.country }}
            </div>

            <div>{{ film.description }}</div>
        </v-card-text>

        <v-divider class="mx-4"></v-divider>

        <v-card-title>Genres</v-card-title>

        <v-card-text>
            <v-chip-group
                active-class="deep-purple accent-4 white--text"
                column
            >
                <template v-for="genre in film.genres">
                    <v-chip>{{ genre }}</v-chip>
                </template>
            </v-chip-group>
        </v-card-text>

        <v-card-actions v-if="showAction">
            <v-btn
                color="deep-purple lighten-2"
                text
                :to="{name: 'film', params: {slug: film.slug}}"
            >
                View
            </v-btn>
        </v-card-actions>
    </v-card>
</template>

<script>
export default {
    name: "Film",
    props: {
        film: {
            type: Object,
            required: true
        },
        showAction: {
            type: Boolean,
            default: true
        }
    }
}
</script>

<style scoped>

</style>

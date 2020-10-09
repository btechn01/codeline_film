<template>
    <div>
        <v-card
            class="mx-auto mt-12 mb-2"
        >
            <v-list rounded max-height="500px" style="overflow: auto">
                <template v-for="comment in comments">
                    <CommentItem :key="comment.id" :comment="comment"/>
                </template>
            </v-list>
        </v-card>
        <v-form v-if="authenticatedUser.name" @submit.prevent="submitComment" ref="form">
            <v-layout wrap>
                <v-flex xs12>
                    <v-text-field no-resize
                                  solo
                                  counter
                                  prepend-inner-icon="mdi-chat"
                                  v-model="body" :rules="[v => !!v || 'Required']"
                                  label="Comment"/>
                </v-flex>
                <v-flex xs12 style="text-align: right">
                    <v-btn type="submit" color="primary" small>
                        Comment
                    </v-btn>
                </v-flex>
            </v-layout>
        </v-form>
        <LoginRegister v-else/>
    </div>
</template>

<script>
import CommentItem from "./CommentItem";
import {mapActions, mapGetters} from "vuex";
import {AUTHENTICATED_USER, COMMENT} from "../store/constants/access_store";
import LoginRegister from "./LoginRegister";

export default {
    name: "Comments",
    components: {LoginRegister, CommentItem},
    props: {
        comments: {
            type: Array,
            required: true
        },
        filmId: {
            required: true
        }
    },
    data: () => ({
        body: null,
    }),
    computed: {
        ...mapGetters({
            authenticatedUser: AUTHENTICATED_USER
        })
    },
    methods: {
        ...mapActions({
            comment: COMMENT
        }),
        submitComment() {
            if (this.$refs.form.validate()) {
                this.comment({'comment': this.body, 'film_id': this.filmId})
                this.$refs.form.reset()
            }
        }
    },
}
</script>

<style scoped>

</style>

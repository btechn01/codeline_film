<template>
    <v-list-item three-line>
        <v-list-item-avatar>
            <v-img src="https://www.alliancerehabmed.com/wp-content/uploads/icon-avatar-default.png"></v-img>
        </v-list-item-avatar>

        <v-list-item-content>
            <v-list-item-title v-html="comment.user.name"></v-list-item-title>
            <v-list-item-subtitle v-html="comment.comment"></v-list-item-subtitle>
        </v-list-item-content>
    </v-list-item>
</template>

<script>
export default {
    name: "CommentItem",
    props: {
        comment: {
            type: Object,
            required: true
        }
    }
}
</script>

<style scoped>

</style>

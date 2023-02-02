<template>
    <div>

        <h1> lista dei posts</h1>
        <PostsList />
    </div>
</template>

<script>
import PostsList from "../../../components/posts/PostsList.vue"
export default {
    name: 'PostsIndex',
    components: {
        PostsList
    },
    data() {
        return {
        }
    },
    methods: {
    }
}
</script>


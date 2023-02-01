<template>
    <div>
        <!-- <h1>Work in progress</h1> -->
        <WorkInProgress />

        <!-- Scrivere i dati dei posts -->
        <PostsList />
    </div>
</template>

<script>
import WorkInProgress from "../components/WorkInProgress.vue"
import PostsList from "../components/posts/PostsList.vue"
export default {
    name: 'App',
    components: {
        WorkInProgress,
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

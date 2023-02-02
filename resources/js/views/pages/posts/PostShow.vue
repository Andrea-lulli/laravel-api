<template>
  <div class="text-center">
    <h1>Show</h1>
    <PostCard />
  </div>
</template>

<script>
import PostCard from "../../../components/posts/PostCard.vue";

export default {
  name: "PostShow",
  components: {
    PostCard
  },
};
</script>

<style lang="scss" scoped>
</style>

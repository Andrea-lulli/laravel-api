<template>
  <div class="text-center">

    <h1 class="m-4">{{ post.title }}</h1>

    <p class="m-2">
      {{ post.body }}
    </p>
  </div>
</template>

<script>
export default {
  name: "PostCard",
  components: {},
  data() {
    return {
      post: null,
    };
  },
  mounted() {
    this.getPost();
  },
  methods: {
    getPost() {
      axios
        .get("http://localhost:8000/api/posts/" + this.$route.params.id)
        .then((res) => {
          console.log(res);
          this.post = res.data;
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
};
</script>

<style scoped lang="scss">
</style>

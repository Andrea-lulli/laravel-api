


1. controller per API
php artisan make:controller Api/PostController --api

2. installa vue-router ver. 3
npm install vue-router@3

3. crea file routes.js

import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)


import HomePage from './views/pages/HomePage.vue'
import AboutUs from './views/pages/AboutUs.vue'

import PostsIndex from './views/pages/posts/PostsIndex.vue'
import PostShow from './views/pages/posts/PostShow.vue'




const router = new VueRouter({

    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: HomePage
        },
        {
            path: '/about-us',
            name: 'about-us',
            component: AboutUs
        },
        {

            path: '/posts',
            name: 'posts',
            component: PostsIndex
        },
        {

            path: '/posts/:id',
            name: 'singlePost',
            component: PostShow
        },

    ]
});

export default router;


4. modifica file app.js

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import router from './routes.js'

import App from './views/App';

const app = new Vue({
    el: '#root',
    router,
    render: h => h(App),
});


5. crea le varie pagine dentro js/views/homege-vue

6. si usa per richiamare le varie rotte nell header:

<router-link class="navbar-brand" :to="{ name: 'home' }">Navbar</router-link>

7. modifica nel controller API la show e anche nelle routes/api.php aggiungi la uova rotta show con id dinamico 

 public function show($id)
    {
        $post = Post::With('category', 'tags')->find($id);
        if (!$post)
            return response('Post non trovato', 404);

        return response()->json($post);
    }


8. nella show compila axios per prendere la singola card con params id dimanico che collega punto 9 : 

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


9. nella postlist dove si trova la lista completa di tutte le singole card crea un router-link  con il parametro id dinamico per andare nella show :

<router-link :to="`/posts/${elem.id}`" >
    {{ elem.title }}
</router-link>

<template>
    <div class="d-flex justify-content-center m-5 " data-bs-theme="dark">

        <div>
            <LoaderComp v-if="isLoading" />

        <ul v-else-if="posts.length">
            <li v-for="elem in posts" :key="elem.id" class="border-top p-2">
                <router-link :to="`/posts/${elem.id}`" >
                    {{ elem.title }}
                </router-link>

                <div v-if="elem.category">
                    {{ elem.category.name }}
                </div>
                <ul>
                    <li v-for="(tag , index) in elem.tags" :key="index">{{ tag.name }}</li>
                </ul>
            </li>
        </ul>
        <p v-else>Non ci sono post </p>


        <Pagination @on-page-change="getPosts" :pagination="pagination" />


        </div>



    </div>
</template>

<script>
import LoaderComp from '../LoaderComp.vue'
import Pagination from '../Pagination.vue'
export default {
    name: 'PostsList',
    components: {
        LoaderComp,
        Pagination
    },
    data() {
        return {
            posts: [],
            isLoading: false,
            pagination: {}
        }
    },
    mounted() {
        this.getPosts();
    },
    methods: {
        getPosts(page = 1) {
            this.isLoading = true
            axios.get('http://localhost:8000/api/posts?page=' + page)
                .then((res) => {
                    console.log(res.data);



                    const { data, current_page, last_page } = res.data;
                    this.posts = data;


                    this.pagination = {
                        lastPage: last_page,
                        currentPage: current_page
                    }

                     //this.posts = res.data.data
                    // const data = res.data.data;
                    // const current_page = res.data.current_page;
                    // const last_page = res.data.last_page;
                }).catch(err => {
                    console.log(err)
                }).then(() => {
                    this.isLoading = false
                })
        }
    }
}
</script>


<template>
    <div class="d-flex">
        <i class="fa fa-star" v-for="star in fullStars" :key="star + 'fs'"></i>
        <i class="fa fa-star-half-alt" v-for="halfStar in halfStar" :key="halfStar + 'hs'"></i>
        <i class="far fa-star" v-for="emptyStar in emptyStars" :key="emptyStar + 'es'"></i>
    </div>
</template>

<script>
    export default {
        name: "StarRating",
        props: {
            rating: Number,
        },
        computed: {
            halfStar() {
                return 1;
            },
            fullStars() {
                return 2;
            },
            emptyStars() {
                return 2;
            }
        }
    }
</script>

<style scoped>

</style>
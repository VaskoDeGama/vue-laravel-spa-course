<template>
    <div class="d-flex">
        <i class="fa fa-star"
           v-for="star in fullStars"
           :key="star + 'full'"
           @click="$emit('rating:changed', star)"
        ></i>
        <i class="fa fa-star-half-alt" v-if="halfStar"></i>
        <i class="far fa-star"
           v-for="emptyStar in emptyStars"
           :key="emptyStar + 'empty'"
           @click="$emit('rating:changed', fullStars + emptyStar)"
        ></i>
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
                const fraction = Math.round(
                    (this.rating - Math.floor(this.rating)) * 100
                );
                return fraction > 0 && fraction < 50;
            },
            fullStars() {
                return Math.round(this.rating);
            },
            emptyStars() {
                return 5 - Math.ceil(this.rating);
            }
        },
        created() {


        },
    }
</script>

<style scoped>

</style>
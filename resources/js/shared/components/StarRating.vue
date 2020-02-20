<template>
    <div class="d-flex">
        <i class="fa fa-star"
           v-for="star in fullStars"
           :key="star + 'full'"
           @click="$emit('input', star)"
        ></i>
        <i class="fa fa-star-half-alt" v-if="halfStar"></i>
        <i class="far fa-star"
           v-for="emptyStar in emptyStars"
           :key="emptyStar + 'empty'"
           @click="$emit('input', fullStars + emptyStar)"
        ></i>
    </div>
</template>

<script>
    export default {
        name: "StarRating",
        props: {
            value: Number,
        },
        computed: {
            halfStar() {
                const fraction = Math.round(
                    (this.value - Math.floor(this.value)) * 100
                );
                return fraction > 0 && fraction < 50;
            },
            fullStars() {
                return Math.round(this.value);
            },
            emptyStars() {
                return 5 - Math.ceil(this.value);
            }
        },
        created() {


        },
    }
</script>

<style scoped>

</style>
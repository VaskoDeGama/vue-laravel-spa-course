<template>
    <div class="d-md-block d-none padding-rem">
        <h6 class="text-uppercase text-secondary font-weight-bolder">Review List</h6>

        <div class="" v-if="!isLoaded">
            No reviews yet
        </div>
        <div v-else class="border-bottom pt-1 mb-3 " v-for="(review,index) in reviews" :key="index">
            <div class="row">
                <div class="col-md-6">Vasiliy Kamenyuk</div>
                <div class="col-md-6 d-flex justify-content-end">

                    <star-rating :value="review.rating"></star-rating>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">{{ review.created_at | fromNow }}</div>
            </div>
            <div class="row">
                <div class="col-md-12 pt-4 pb-4">
                    {{review.content}}
                </div>
            </div>
        </div>


    </div>
</template>

<script>
    import moment from 'moment';
    import StarRating from "../shared/components/StarRating";
    export default {
        components: {StarRating},
        props: {
            bookableId: [String,Number],
        },
        data() {
            return {
                reviews: null,
                isLoaded: false,
            }
        },
        created() {
            this.isLoaded = false;
            axios.get(`/api/bookables/${this.bookableId}/reviews`)
                .then( res => {
                    this.reviews = res.data.data;
                    this.isLoaded = true;
                });
        },
        filters: {

        }
    }
</script>

<style scoped>
 .padding-rem{
     padding-left: 1.25rem;
     padding-right: 1.25rem;
 }
</style>
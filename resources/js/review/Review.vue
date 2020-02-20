<template>
    <div>
        <div v-if="!isLoaded">
            Loading...
        </div>
        <div v-else>
            <div v-if="existingReview">
                <h3>You've already left a review for this booking!</h3>
            </div>
            <div v-else>
                <div class="form-group">
                    <label class="text-muted">Select the star rating (1 is worst - 5 is best)</label>
                    <star-rating class="fa-3x" v-model="review.rating">
                    </star-rating>
                </div>
                <div class="form-group">
                    <label class="text-muted" for="content">Describe your experiance with</label>
                    <textarea v-model="review.content" name="content" cols="30" rows="10" class="form-control"></textarea>
                </div>
                <button class="btn btn-large btn-primary btn-block">Submit</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                review: {
                    rating: 5,
                    content: null,
                },
                existingReview: null,
                isLoaded: false,
            }
        },
        created() {
            this.isLoaded = false;
            axios.get(`/api/reviews/${this.$route.params.id}`)
                .then(res => this.existingReview = res.data.data)
                .catch(err => {

                })
                .then(() => this.isLoaded = true);
        },
        computed: {
            alredyReviewed() {
                return this.existingReview !== null;
            }
        },


    }
</script>
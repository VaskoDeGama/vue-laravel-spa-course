<template>
    <div class="row">

        <div :class="[{'col-md-4': !isLoaded || !alredyReviewed}, {'d-none': isLoaded && alredyReviewed }]">
            <div class="card">
                <div class="card-body">
                    <div v-if="alredyReviewed">Loading...</div>
                    <div v-else>
                        <p>
                            Stayed at <router-link
                                :to="{ name: 'bookable', params: {id: booking.bookable.bookable_id } }">
                            {{ booking.bookable.title }}
                        </router-link>
                        </p>
                        <p>
                            From {{booking.from}} to {{booking.to}}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div :class="[{'col-md-8': !isLoaded || !alredyReviewed }, {'col-md-12': isLoaded && alredyReviewed}]">
            <div v-if="!isLoaded">
                Loading...
            </div>
            <div v-else>
                <div v-if="alredyReviewed">
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
                isLoaded: true,
                booking: null,
                idFromParams: null,
            }
        },
        created() {
            this.isLoaded = false;
            //fetch review by id
            axios.get(`/api/reviews/${this.$route.params.id}`)
                .then(res => {
                    this.existingReview = res.data.data
                })
                .catch(err => {
                    if (
                        err.response &&
                        err.response.status &&
                        404 === err.response.status
                    ) {
                        //fecth a booking by review_key
                        return axios
                            .get(`/api/booking-by-review/${this.$route.params.id}`)
                            .then(res => {
                                this.booking = res.data.data;
                            });
                    }
                })
                .then(() => this.isLoaded = true);
        },
        computed: {
            alredyReviewed() {
                return this.hasReview || !this.hasBooking;
            },
            hasReview() {
                return this.existingReview !== null;
            },
            hasBooking() {
                return this.booking !== null;
            },

        },


    }
</script>
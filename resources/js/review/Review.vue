<template>
    <div>
        <success v-if="success">
            You've left review, thank you very much!
        </success>
        <fatal-error v-if="error"></fatal-error>

        <div class="row" v-if="!success && !error">
            <div :class="[{'col-md-4': twoColumns}, {'d-none': oneColumn}]">
                <div class="card">
                    <div class="card-body">
                        <div v-if="isLoading">Loading...</div>
                        <div v-if="hasBooking">
                            <p>
                                Stayed at
                                <router-link
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
            <div :class="[{'col-md-8': twoColumns }, {'col-md-12': oneColumn}]">
                <div v-if="isLoading">Loading...</div>
                <div v-else>
                    <div v-if="hasReview">
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
                            <textarea :class="[{'is-invalid': this.errorFor('content')}]" class="form-control" cols="30" name="content"
                                      rows="10"
                                      v-model="review.content"></textarea>
                            <v-errors :errors="errorFor('content')"></v-errors>
                        </div>
                        <button :disabled="sending" @click.prevent="submit" class="btn btn-large btn-primary btn-block">
                            Submit
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
    import {is404, is422} from './../shared/utils/response'
    import validationsError from './../shared/mixins/validationsError'

    export default {
        mixins: [validationsError],
        data() {
            return {
                review: {
                    id: null,
                    rating: 5,
                    content: null,
                    created_at: null
                },
                existingReview: null,
                isLoading: false,
                booking: null,
                error: false,
                sending: null,
                success: false,
            }
        },
        async created() {
            this.isLoading = true;
            this.review.id = this.$route.params.id;
            try {
                this.existingReview = (await axios.get(`/api/reviews/${this.review.id}`)).data.data;
            } catch (err) {
                if (is404(err)) {
                    try {
                        this.booking = (await axios.get(`/api/booking-by-review/${this.review.id}`)).data.data;
                    } catch (err) {
                        this.error = is404(err);
                    }
                } else {
                    this.error = true;
                }
            }
            this.isLoading = false;
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
            oneColumn() {
                return !this.isLoading && this.alredyReviewed;
            },
            twoColumns() {
                return this.isLoading || !this.alredyReviewed;
            },

        },
        methods: {
            submit() {
                this.errors = null;
                this.sending = true;
                this.success = false;

                axios.post(`/api/reviews`, this.review)
                    .then(res => {
                        this.success = res.status === 201;
                    })
                    .catch(err => {
                        if (is422(err)) {
                            const errors = err.response.data.errors;

                            if (errors['content'] && 1 === _.size(errors)) {
                                this.errors = errors;
                                return;
                            }
                        }
                        this.error = true;
                    })
                    .then(() => {
                        this.sending = false;
                    });
            },
        }


    }
</script>
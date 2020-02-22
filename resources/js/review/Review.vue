<template>
    <div>
        <fatal-error v-if="error"></fatal-error>
        <div class="row" v-else>
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
                            <textarea class="form-control" cols="30" name="content" rows="10"
                                      v-model="review.content" :class="[{'is-invalid': this.errorFor('content')}]"></textarea>
                            <div class="invalid-feedback" v-for="(error,index) in this.errorFor('content')" :key="index + 'content'">
                                {{error}}
                            </div>
                        </div>
                        <button class="btn btn-large btn-primary btn-block" @click.prevent="submit" :disabled="sending">Submit</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
    import {is404, is422} from './../shared/utils/response'


    export default {
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
                errors: null,
                sending: null,
            }
        },
        created() {
            this.isLoading = true;
            this.review.id = this.$route.params.id;

            axios.get(`/api/reviews/${this.review.id}`)
                .then(res => this.existingReview = res.data.data)
                .catch(err => {
                    if (is404(err)) {
                        return axios.get(`/api/booking-by-review/${this.review.id}`)
                            .then(res => this.booking = res.data.data)
                            .catch(err => {
                                this.error = is404(err);
                            })
                    }
                    this.error = true;
                })
                .then(() => {
                    this.isLoading = false;
                });
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
                axios.post(`/api/reviews`, this.review)
                    .then(res => {
                        console.log(res);
                    })
                    .catch(err => {
                        if(is422(err)) {
                            const errors = err.response.data.errors;

                            if(errors['content'] && 1 === _.size(errors)) {
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
            errorFor(field) {
                return null !== this.errors && this.errors[field] ? this.errors[field]  : null;
            },
        }


    }
</script>
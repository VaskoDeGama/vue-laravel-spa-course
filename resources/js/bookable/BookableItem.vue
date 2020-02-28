<template>
    <div>
        <fatal-error v-if="error"></fatal-error>
        <div class="row" v-else>
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <div v-if="!loading">
                            <h5>{{bookable.title}}</h5>
                            <hr>
                            <article>
                                {{bookable.description}}
                            </article>
                        </div>
                        <div v-else>
                            Data is loading...
                        </div>
                    </div>
                </div>
                <review-list :bookable-id="bookable.id" v-if="!loading"></review-list>
            </div>
            <div class="col-md-4 pb-4" v-if="!loading">
                <availability :bookable-id="bookable.id" class="mb-4"
                              v-on:availability="checkPrice($event)"></availability>
                <transition name="fade">
                    <price-break-down :price="price" class="mb-4" v-if="price"></price-break-down>
                </transition>
                <transition name="fade">
                    <button class="btn btn-outline-secondary btn-block"
                            v-if="price"
                            @click="addToBasket"
                            :disabled="inBasketAlready"
                    >Book now!</button>
                </transition>

                <button class="btn btn-outline-secondary btn-block"
                        v-if="inBasketAlready"
                        @click="removeFromBasket"
                >Remove from basket</button>

                <div class="mt-4 text-muted warning" v-if="inBasketAlready">
                    Seems like you've added this object to basket already. If you want to change dates, remove from the
                    basket first
                </div>
            </div>
        </div>x
    </div>

</template>

<script>
    import Availability from './Availability';
    import ReviewList from './ReviewList';
    import PriceBreakDown from './PriceBreakDown';
    import {mapState, mapGetters} from "vuex";

    export default {
        components: {
            Availability,
            ReviewList,
            PriceBreakDown,
        },
        data() {
            return {
                bookable: null,
                loading: false,
                price: null,
                error: null,
            }
        },
        async created() {
            this.loading = true;
            try {
                this.bookable = (await axios.get(`/api/bookables/${this.$route.params.id}`)).data.data;
                this.loading = false;
            } catch (err) {
                this.error = err;
            }
        },
        computed: {
            ...mapState({
                lastSearch: 'lastSearch',
            }),
            inBasketAlready() {
                if (null === this.bookable) {
                    return false;
                }
                return this.$store.getters.inBasketAlready(this.bookable.id);
            }

        },
        methods: {
            async checkPrice(hasAvailability) {
                if (!hasAvailability) {
                    this.price = null;
                    return;
                }

                try {
                    this.price = (await axios.get(`/api/bookables/${this.bookable.id}/price?from=${this.lastSearch.from}&to=${this.lastSearch.to}`)).data.data;
                } catch (err) {
                    this.price = null;
                }
            },
            addToBasket() {
                this.$store.dispatch('addBasket', {
                    bookable: this.bookable,
                    price: this.price,
                    dates: this.lastSearch
                })
            },
            removeFromBasket() {
                this.$store.dispatch('removeBasket', this.bookable.id);
            }
        }
    }
</script>

<style scoped>
    .warning {
        font-size: 0.7rem;
    }
</style>
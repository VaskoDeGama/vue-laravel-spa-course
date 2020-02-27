<template>
    <div>
        <fatal-error v-if="error"></fatal-error>
        <div class="row" v-else>
            <div class="col-md-8">
                <div class="card mb-4" >
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
                <review-list v-if="!loading" :bookable-id="bookable.id"></review-list>
            </div>
            <div class="col-md-4 pb-4" v-if="!loading">
                <availability :bookable-id="bookable.id"  v-on:availability="checkPrice($event)" class="mb-4"></availability>
                <transition name="fade">
                    <price-break-down v-if="price" :price="price" class="mb-4"></price-break-down>
                </transition>
                <transition name="fade">
                    <button class="btn btn-outline-secondary btn-block" v-if="price">Book now!</button>
                </transition>
            </div>
        </div>
    </div>

</template>

<script>
    import Availability from './Availability';
    import ReviewList from './ReviewList';
    import PriceBreakDown from './PriceBreakDown';
    import {mapState} from "vuex";
    export default {
        components: {
            Availability,
            ReviewList,
            PriceBreakDown,
        },
        data() {
            return  {
                bookable: null,
                loading: false,
                price: null,
                error: null,
            }
        },
        async created() {
            this.loading = true;
            try {
                this.bookable  = (await axios.get(`/api/bookables/${this.$route.params.id}`)).data.data;
                this.loading = false;
            } catch (err) {
                this.error = err;
            }
        },
        computed: mapState ({
           lastSearch: 'lastSearch'
        }),
        methods: {
            async checkPrice(hasAvailability) {
                if(!hasAvailability) {
                    this.price = null;
                    return;
                }

                try {
                    this.price  = (await axios.get(`/api/bookables/${this.bookable.id}/price?from=${this.lastSearch.from}&to=${this.lastSearch.to}`)).data.data;
                } catch (err) {
                    this.price = null;
                }

            },
        }
    }
</script>
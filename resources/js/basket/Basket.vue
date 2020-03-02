<template>
    <div>
        <div class="row">
            <div class="col-md-8">
                <div class="form-row">
                    <div class="col-md-6 form-group">
                        <label for="firstName">First name</label>
                        <input class="form-control" id="firstName" type="text"/>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="lastName">Last name</label>
                        <input class="form-control" id="lastName" type="text"/>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-12 form-group">
                        <label for="email">Email</label>
                        <input class="form-control" id="email" type="email"/>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6 form-group">
                        <label for="street">Street</label>
                        <input class="form-control" id="street" type="text"/>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="city">City</label>
                        <input class="form-control" id="city" type="text"/>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6 form-group">
                        <label for="country">Country</label>
                        <input class="form-control" id="country" type="text"/>
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="state">State</label>
                        <input class="form-control" id="state" type="text"/>
                    </div>
                    <div class="col-md-2 form-group">
                        <label for="zip">Zip</label>
                        <input class="form-control" id="zip" type="text"/>
                    </div>
                </div>
                <hr/>
                <div class="row">
                    <div class="col-md-12 form-group">
                        <button class="btn btn-lg btn-primary btn-block" type="submit">Book now!</button>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="d-flex justify-content-between">
                    <h6 class="text-uppercase text-secondary font-weight-bolder">Your cart</h6>
                    <h6 class="badge badge-secondary text-uppercase">
                        <span v-if="itemsInBasket">Items {{ itemsInBasket }}</span>
                        <span v-else>Empty</span>
                    </h6>
                </div>
                <transition-group name="fade" tag="div">
                    <div :key="item.bookable.id" v-for="item in basket">
                        <div class="pt-2 pb-2 border-top d-flex justify-content-between">
                        <span>
                            <router-link :to="{ name: 'bookable', params: {id: item.bookable.id} }">{{item.bookable.title}}</router-link>
                        </span>
                            <span class="font-weight-bold">${{ item.price.total }}</span>
                        </div>
                        <div class="pt-2 pb-2 d-flex justify-content-between">
                            <span>From {{ item.dates.from }}</span>
                            <span>To {{ item.dates.to }}</span>
                        </div>
                        <div @click="$store.dispatch('removeFromBasket', item.bookable.id)"
                             class="pt-2 pb-2 text-right">
                            <button class="btn btn-sm btn-outline-secondary">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    </div>
                </transition-group>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapGetters, mapState} from 'vuex';

    export default {
        name: "Basket",
        computed: {
            ...mapGetters(['itemsInBasket']),
            ...mapState({
                basket: state => state.basket.items
            })
        }
    }
</script>

<style scoped>
    h6.badge {
        font-size: 100%;
    }

    a {
        color: black;
    }

</style>
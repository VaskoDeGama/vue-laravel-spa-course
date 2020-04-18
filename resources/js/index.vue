<template>
    <div>
        <div class="navbar navbar-expand-lg bg-light border-bottom navbar-light">
            <router-link class="navbar-brand mr-auto" :to="{ name: 'home' }">Dashboard</router-link>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <router-link class="btn nav-button" :to="{name: 'basket'}">
                        Basket
                        <span v-if="itemsInBasket" class="badge badge-secondary">
                            {{itemsInBasket}}
                        </span>
                    </router-link>
                </li>
                <li class="nav-item" v-if="!isLoggedIn">
                    <router-link class="nav-link" :to="{name: 'login'}" >Register</router-link>
                </li>
                <li class="nav-item" v-if="!isLoggedIn">
                    <router-link class="nav-link" :to="{name: 'login'}" >Sign-in</router-link>
                </li>
                <li class="nav-item" v-if="isLoggedIn">
                    <a href="#" @click.prevent="logout" class="nav-link">Logout</a>
                </li>
            </ul>
        </div>
        <div class="container mt-4 mb-4 pr-4 pl-4">
            <router-view></router-view>
        </div>

    </div>
</template>

<script>
    import {mapState, mapGetters} from 'vuex';


    export default {
        data() {
            return {
                lastSearch: this.$store.state.lastSearch,
            }
        },
        computed: {
            ...mapState({
                lastSearchComputed: 'lastSearch',
                isLoggedIn: 'isLoggedIn',

            }),
            ...mapGetters({
                itemsInBasket: 'itemsInBasket',
            }),
        },
        methods: {
            async logout() {
                try {
                    axios.post('/logout');
                    this.$store.dispatch('logout');
                } catch (error) {
                    this.$store.dispatch('logout');
                }
            }
        }
    }
</script>
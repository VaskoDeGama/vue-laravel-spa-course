<template>
    <div>
        <h6 class="text-uppercase text-secondary font-weight-bolder">
            Check Availability
            <transition name="fade">
                <span v-if="noAvailability" class="text-danger">(NOT AVAILABLE)</span>
                <span v-if="hasAvailability" class="text-success">(AVAILABLE)</span>
            </transition>


        </h6>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label class="text-uppercase text-secondary font-weight-bolder" for="from">From</label>
                <input

                        v-model="from"
                        type="text"
                        id="from"
                        name="from"
                        class="form-control form-control-sm"
                        placeholder="Start date"
                        @keyup.enter="check"
                        :class="[{'is-invalid': this.errorFor('from')}]"
                >
                <v-errors :errors="errorFor('from')"></v-errors>
            </div>
            <div class="form-group col-md-6">
                <label class="text-uppercase text-secondary font-weight-bolder" for="to">To</label>
                <input
                        v-model="to"
                        type="text"
                        id="to"
                        name="to"
                        class="form-control form-control-sm"
                        placeholder="End date"
                        @keyup.enter="check"
                        :class="[{'is-invalid': this.errorFor('to')}]"
                >
                <v-errors :errors="errorFor('to')"></v-errors>
            </div>
        </div>
        <button
                class="btn btn-secondary btn-block"
                @click="check"
                :disabled="!isLoaded">
            <loading-indicator :loading="this.isLoaded" object="spinner" pulse="true"> Cheking availability...</loading-indicator>
        </button>
    </div>
</template>



<script>
    import {is422} from './../shared/utils/response'
    import validationsError from './../shared/mixins/validationsError'

    export default {
        mixins: [validationsError],
        props: {
          bookableId: [String,Number],
        },
        data() {
            return {
                from: this.$store.state.lastSearch.from,
                to: this.$store.state.lastSearch.to,
                isLoaded: true,
                status: null,
            }
        },
        methods: {
            async check() {
                this.isLoaded = false;
                this.errors = null;

                this.$store.dispatch('setLastSearch', {
                    from: this.from,
                    to: this.to,
                });

                try {
                    this.status = (await axios.get(`/api/bookables/${this.bookableId}/availability?from=${this.from}&to=${this.to}`)).status;
                    this.$emit('availability', this.hasAvailability);
                } catch (err) {
                    if (is422(err)) {
                        this.errors = err.response.data.errors;
                    }
                    this.status = err.response.status;
                }

                this.isLoaded=true;
            },

        },
        computed: {
            hasErrors() {
                return 422 === this.status && this.errors !== null;
            },
            hasAvailability() {
                return 200 === this.status;
            },
            noAvailability() {
                return 404 === this.status;
            }

        }
    }
</script>

<style scoped>
    label {
        font-size: 0.7em;
    }
    .is-invalid {
        background-image: none;
    }

</style>
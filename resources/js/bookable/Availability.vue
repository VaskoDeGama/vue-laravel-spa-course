<template>
    <div>
        <h6 class="text-uppercase text-secondary font-weight-bolder">
            Check Availability
            <span v-if="noAvailability" class="text-danger">(NOT AVAILABLE)</span>
            <span v-if="hasAvailability" class="text-success">(AVAILABLE)</span>
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
                :disabled="!isLoaded"
        >Check</button>
    </div>
</template>



<script>
    import {is404, is422} from './../shared/utils/response'

    export default {
        props: {
          bookableId: [String,Number],
        },
        data() {
            return {
                from: null,
                to: null,
                isLoaded: true,
                status: null,
                errors: null,
            }
        },
        methods: {
            check() {
                this.isLoaded = false;
                this.errors = null;
                axios
                    .get(`/api/bookables/${this.bookableId}/availability?from=${this.from}&to=${this.to}`)
                    .then(res => {
                        this.status = res.status;
                        this.isLoaded = true;
                    })
                    .catch(error => {
                        if (is422(error)) {
                            this.errors = error.response.data.errors;
                        }
                        this.status = error.response.status;
                    })
                    .then(() => this.isLoaded = true);

            },
            errorFor(field) {
                return this.hasErrors && this.errors[field] ? this.errors[field]  : null;
            }
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
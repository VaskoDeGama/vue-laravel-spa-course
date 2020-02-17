<template>
    <div>
        <h6 class="text-uppercase text text-secondary font-weight-bolder">Check Availability</h6>

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
                >
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
                >
            </div>
        </div>
        <button
                class="btn btn-secondary btn-block"
                @click="check"
                :disabled="!isLoaded"
        >Check</button>
    </div>
</template>

<style>
    label {
       font-size: 0.7em;
    }
</style>

<script>
    export default {
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
                    .get(`/api/bookables/${this.$route.params.id}/availability?from=${this.from}&to=${this.to}`)
                    .then(res => {
                        this.status = res.status;
                        this.isLoaded = true;
                    })
                    .catch(error => {
                        if (422 === error.response.status) {
                            this.errors = error.response.data.errors;
                        }
                        this.status = error.response.status;
                    })
                    .then(() => this.isLoaded = true);

            }
        }
    }
</script>
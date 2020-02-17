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
        <button class="btn btn-secondary btn-block" @click="check">Check</button>
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
            }
        },
        methods: {
            check() {
                alert('cheked');
            }
        }
    }
</script>
<template>
    <span>
        <span v-if="this.loading">Check!</span>
        <span v-if="!this.loading"><i :class="this.type"></i><slot></slot></span>
    </span>
</template>

<script>
    export default {
        name: "LoadingIndicator",
        props: {
            loading: Boolean,
            object: String,
            pulse: [String,Boolean],
        },
        data() {
            return{
                type: `fas fa-${this.object || 'cog'} fa-${(this.pulse ? 'pulse' : 'spin')}`
            }
        }

    }
</script>

<style scoped>

</style>
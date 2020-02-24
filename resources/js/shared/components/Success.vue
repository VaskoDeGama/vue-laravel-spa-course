<template>
    <div class="text-center error">
        <i class="fa fa-check-circle"></i>
        <h1 class="mt-4">Done!</h1>
        <h2>
            <slot></slot>
        </h2>
    </div>
</template>

<script>
    export default {
        name: "NotFound",

    }
</script>

<style scoped>
    .error {
        color: #2a9055;
        font-size: 10rem;
    }
</style>
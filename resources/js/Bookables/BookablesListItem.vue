<template>
    <div>
        <h2>{{ itemTitle }}</h2>
        <p> {{ itemContetn }}</p>
    </div>
</template>


<script>
    export default {
        props: {
            itemTitle: String,
            itemContetn: String,
            itemPrice: Number,
        },

    }
</script>
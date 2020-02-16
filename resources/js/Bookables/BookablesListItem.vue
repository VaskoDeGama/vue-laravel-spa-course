<template>
    <div class="card">
        <div class="card-body">
            <h2 class="card-title">{{ itemTitle +' '+ itemId }}</h2>
            <p class="card-text">{{ itemContetn }}</p>
            <a href="#" class="btn btn-primary float-right">{{ itemPrice * itemId }}</a>
        </div>
    </div>
</template>


<script>

    export default {
        props: {
            itemId: Number,
            itemTitle: String,
            itemContetn: String,
            itemPrice: Number,
        },

    }
</script>
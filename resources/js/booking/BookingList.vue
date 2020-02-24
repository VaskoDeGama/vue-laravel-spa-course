<template>
    <div>
        <booking-list-item v-for="i in 5" :key="i"></booking-list-item>
    </div>


</template>

<script>
    import BookingListItem from './BookingListItem'
    export default {
        name: "ReviewList",
        components: {BookingListItem},

    }
</script>

<style scoped>

</style>
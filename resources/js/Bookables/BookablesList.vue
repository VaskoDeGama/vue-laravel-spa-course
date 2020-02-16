<template>
    <div>
        <bookable-list-item item-title="Villa"
                            item-contetn="some txt from"
                            :item-price="10000">
        </bookable-list-item>
        <bookable-list-item item-title="Villa 2"
                            item-contetn="some txt from 2"
                            :item-price="20000">
        </bookable-list-item>
        <bookable-list-item item-title="Villa 3"
                            item-contetn="some txt from 3"
                            :item-price="30000">
        </bookable-list-item>

    </div>
</template>

<script>
    import BookableListItem from './BookablesListItem';
    export default {
        components: {
            BookableListItem,
        }
    }
</script>
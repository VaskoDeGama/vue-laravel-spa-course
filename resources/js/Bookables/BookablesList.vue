<template>
    <div>
        <div v-if="isLoading">
            Data is loading...
        </div>
        <div v-else>
            <div class="row mb-4" v-for="row in rows" :key="row+'row'">
                <div class="col"
                     v-for="(item, column) in itemsInRow(row)"
                     :key="'col'+column" >
                        <bookable-list-item
                                :item-id="item.id"
                                :item-title="item.title"
                                :item-contetn="item.content"
                                :item-price="item.price" >
                        </bookable-list-item>
                </div>
                <div class="col" v-for="placeHolder in placeHoldersInRow(row)" :key="placeholder +'p'">

                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import BookableListItem from './BookablesListItem';

    export default {
        components: {
            BookableListItem,
        },
        data() {
            return {
                items: null,
                isLoading: false,
                columns: 3,

            }
        },
        computed: {
           rows() {
               return this.items ? Math.ceil(this.items.length / this.columns) : 0;
           }
        },
        methods: {
            itemsInRow(row) {
                return this.items.slice((row - 1) * this.columns, row * this.columns )
            },
            placeHoldersInRow(row) {
                return this.columns - this.itemsInRow(row).length
            }
        },
        created() {
            this.isLoading = true;
            setTimeout(() => {
                this.items = [
                    {
                        id: 1,
                        title : "Villa",
                        content: "Some information about this villa",
                        price: 1000,
                    },
                    {
                        id: 2,
                        title : "Villa",
                        content: "Some information about this villa",
                        price: 1000,
                    },
                    {
                        id: 3,
                        title : "Villa",
                        content: "Some information about this villa",
                        price: 1000,
                    },
                    {
                        id: 4,
                        title : "Villa",
                        content: "Some information about this villa",
                        price: 1000,
                    },
                    {
                        id: 5,
                        title : "Villa",
                        content: "Some information about this villa",
                        price: 1000,
                    },
                    {
                        id: 6,
                        title : "Villa",
                        content: "Some information about this villa",
                        price: 1000,
                    },
                    {
                        id: 7,
                        title : "Villa",
                        content: "Some information about this villa",
                        price: 1000,
                    },
                    {
                        id: 8,
                        title : "Villa",
                        content: "Some information about this villa",
                        price: 1000,
                    },
                    {
                        id: 9,
                        title : "Villa",
                        content: "Some information about this villa",
                        price: 1000,
                    },
                    {
                        id: 10,
                        title : "Villa",
                        content: "Some information about this villa",
                        price: 1000,
                    }
                ];
                this.isLoading = false;
            }, 3000);
        }
    }
</script>
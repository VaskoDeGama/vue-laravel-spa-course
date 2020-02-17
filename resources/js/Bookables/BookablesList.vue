<template>
    <div>
        <div v-if="isLoading">
            Data is loading...
        </div>
        <div v-else>
            <div class="row" v-for="row in rows" :key="row+'row'">
                <div class="col-md-4 d-flex align-items-stretch  mb-4"
                     v-for="item in itemsInRow(row)"
                     :key="item.id" >
                        <bookable-list-item v-bind="item"></bookable-list-item>
                </div>
                <div class="col" v-for="placeHolder in placeHoldersInRow(row)" :key="placeHolder +'p'">
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

           axios
               .get('/api/bookables')
               .then(res => {
                   this.items = res.data.data;
                   this.isLoading = false;
               });


        }
    }
</script>
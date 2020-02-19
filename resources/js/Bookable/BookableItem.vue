<template>
    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4" >
                <div class="card-body">
                    <div v-if="!isLoaded">
                        <h5>{{item.title}}</h5>
                        <hr>
                        <article>
                            {{item.description}}
                        </article>
                    </div>
                    <div v-else>
                        Data is loading...
                    </div>
                </div>
            </div>
            <review-list :bookable-id="this.bookableId"></review-list>
        </div>
        <div class="col-md-4">
            <availability :bookable-id="this.bookableId"></availability>
        </div>
    </div>
</template>

<script>
    import Availability from './Availability';
    import ReviewList from './ReviewList';
    export default {
        components: {
            Availability,
            ReviewList,
        },
        data() {
            return  {
                item: null,
                isLoaded: false,
                bookableId: this.$route.params.id
            }
        },
        created() {
            this.isLoaded = true;
            axios
                .get(`/api/bookables/${this.$route.params.id}`)
                .then(res => {
                    this.item = res.data.data;
                    this.isLoaded = false;
                })
        }
    }
</script>
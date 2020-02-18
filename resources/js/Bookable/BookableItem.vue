<template>
    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4" >
                <div class="card-body">
                    <div v-if="!isLoading">
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
            <review-list></review-list>
        </div>
        <div class="col-md-4">
            <availability></availability>
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
                isLoading: false,
            }
        },
        created() {
            this.isLoading = true;
            axios
                .get(`/api/bookables/${this.$route.params.id}`)
                .then(res => {
                    this.item = res.data.data;
                    this.isLoading = false;
                })
        }
    }
</script>
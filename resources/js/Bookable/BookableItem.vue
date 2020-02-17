<template>
    <div class="row">
        <div class="col-md-8">
            <div class="card" >
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
        </div>
        <div class="col-md-4">
            avaliable & prices
        </div>
    </div>
</template>

<script>
    export default {
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
                    this.item = res.data;
                    this.isLoading = false;
                })
        }
    }
</script>
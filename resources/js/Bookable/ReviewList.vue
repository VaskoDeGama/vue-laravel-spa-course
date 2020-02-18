<template>
    <div class="d-md-block d-none padding-rem">
        <h6 class="text-uppercase text-secondary font-weight-bolder">Review List</h6>
        <div class="border-bottom pt-1 mb-3 " v-for="item in 3" :key="item">
            <div class="row">
                <div class="col-md-6">Vasiliy Kamenyuk</div>
                <div class="col-md-6 d-flex justify-content-end">STAR RATING</div>
            </div>
            <div class="row">
                <div class="col-md-12">added 5 minutes ago</div>
            </div>
            <div class="row">
                <div class="col-md-12 pt-4 pb-4">
                    Contetn of review
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {

    }
</script>

<style scoped>
 .padding-rem{
     padding-left: 1.25rem;
     padding-right: 1.25rem;
 }
</style>
<template>
    <div>
        {{item.title}}
    </div>
</template>

<script>
    export default {
        data() {
            return  {
                item: null,
            }
        },
        created() {
            axios
                .get(`/api/bookable/${this.$route.params.id}`)
                .then(res => {
                    this.item = res.data;
                    console.log(res.data);
                })
        }
    }
</script>
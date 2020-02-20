<template>
    <div>
        <div class="form-group">
            <label class="text-muted">Select the star rating (1 is worst - 5 is best)</label>
            <star-rating class="fa-3x" v-model="review.rating">
            </star-rating>
        </div>
        <div class="form-group">
            <label class="text-muted" for="content">Describe your experiance with</label>
            <textarea name="content" cols="30" rows="10" class="form-control"></textarea>
        </div>
        <button class="btn btn-large btn-primary btn-block">Submit</button>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                review: {
                    rating: 5,
                    content: null,
                }
            }
        }

    }
</script>
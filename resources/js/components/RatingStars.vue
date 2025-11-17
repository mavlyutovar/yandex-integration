<template>
    <div class="rating-stars">
    <span v-for="index in maxStars" :key="index" class="star">
      {{ index <= fullStars ? '⭐' : '☆' }}
    </span>
    </div>
</template>

<script setup>
import { computed } from 'vue'

const props = defineProps({
    value: {
        type: Number,
        required: true
    },
    maxStars: {
        type: Number,
        default: 5
    }
})

const fullStars = computed(() => Math.floor(props.value))
</script>

<style scoped>
.star {
    font-size: 18px;
    color: #fbbf24;
}
</style>

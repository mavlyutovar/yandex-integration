<template>
    <div class="rating-stars">
        <img
            v-for="index in maxStars"
            :key="index"
            class="star"
            :src="index <= fullStars ? '/images/star-full.svg' : '/images/star-empty.svg'"
            alt="star"
            :style="{ width: size + 'px', height: size + 'px' }"
        />
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
    },
    size: {
        type: Number,
        default: 24
    }
})

const fullStars = computed(() => Math.floor(props.value))
</script>

<style scoped>

.rating-stars {
    display: flex;
    gap: 4px;
}
</style>

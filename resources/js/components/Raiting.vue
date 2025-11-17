<template>
    <div class="rating-component-detailed">
        <div class="rating-header">
            <div class="rating-main">
                <div class="rating-value">4.7</div>
            </div>

            <RatingStars :value="4.7" />
        </div>
        <hr style="margin-bottom: 13px; margin-top: 0px">
        <div class="reviews-count">Всего отзывов: 1 145</div>
    </div>
</template>

<script setup>
import RatingStars from './RatingStars.vue'

</script>

<style scoped>
.rating-component-detailed {
    padding: 12px 24px;
    background: #ffffff;
    border-radius: 16px;
    box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
    border: 1px solid #f1f5f9;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    max-width: 300px;
    height: max-content;
}

.rating-header {
    display: flex;
    align-items: center;
    gap: 16px;
}

.rating-main {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.rating-value {
    font-family: 'Mulish', sans-serif;
    font-weight: 500;
    font-size: 40px;
}

.reviews-count {
    font-family: 'Mulish', sans-serif;
    font-size: 12px;
    color: #363740;
    font-weight: 700;
    margin-bottom: 20px;
    text-align: left;
}

/* Анимации */
.rating-component-detailed {
    transition: all 0.3s ease;
}

.rating-component-detailed:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
}

</style>

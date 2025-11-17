<template>
    <div class="reviews-page">
        <button class="review-yandex">
            📍 Яндекс Карты
        </button>
        <div class="reviews-content">
            <div class="reviews-list">
                <div
                    v-for="review in filteredReviews"
                    :key="review.id"
                    class="review-card"
                >
                    <div class="review-card-content">
                        <div class="review-header">
                            <div class="review-date-branch">
                                <div class="left-info">
                                    <div class="text-branch-info">{{ review.date }}</div>
                                    <div class="text-branch-info">{{ review.branch }} 📍</div>
                                </div>
                                <RatingStars :value="review.rating" />
                            </div>
                        </div>


                        <div class="reviewer-info">
                            <strong class="text-branch-info">{{ review.author }}</strong>
                            <span class="text-branch-info" style="font-size: 10px">{{ review.phone }}</span>
                        </div>

                        <div class="text-branch-info" style="font-weight: 400;">{{ review.text }}</div>
                    </div>
                </div>
            </div>
            <Raiting>

            </Raiting>
        </div>
    </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import Raiting from './Raiting.vue'
import RatingStars from "./RatingStars.vue";

const activeFilter = ref('all')

const reviews = [
    {
        id: 1,
        author: 'Наталья',
        phone: '+7 900 540 40 40',
        date: '12.09.2022 14:22',
        branch: 'Филиал 1',
        text: 'Так, с чего начать... Разнообразная алкогольная продукция, множество закусок и обычных блюд. Кухня вкусная и Разнообразная, от супа и салатов до мясных продуктов. Персонал молодые девушки, общительная и доброжелательные, всегда подскажут, вовремя принесут и вызовут такси. Отдыхали на летней веранде, свежо и тепло, в общем самое то в жаркую погоду. Сами залы не сильно рассмотрел, но видел что они удобные и просторные.',
        type: 'positive',
        rating: 5
    },
    {
        id: 2,
        author: 'Наталья',
        phone: '+7 900 540 40 40',
        date: '12.09.2022 14:22',
        branch: 'Филиал 1',
        text: 'Так, с чего начать... Разнообразная алкогольная продукция, множество закусок и обычных блюд. Кухня вкусная и Разнообразная, от супа и салатов до мясных продуктов. Персонал молодые девушки, общительная и доброжелательные, всегда подскажут, вовремя принесут и вызовут такси. Отдыхали на летней веранде, свежо и тепло, в общем самое то в жаркую погоду. Сами залы не сильно рассмотрел, но видел что они удобные и просторные.',
        type: 'positive',
        rating: 5
    },
    {
        id: 3,
        author: 'Наталья',
        phone: '+7 900 540 40 40',
        date: '12.09.2022 14:22',
        branch: 'Филиал 1',
        text: 'Так, с чего начать... Разнообразная алкогольная продукция, множество закусок и обычных блюд. Кухня вкусная и Разнообразная, от супа и салатов до мясных продуктов. Персонал молодые девушки, общительная и доброжелательные, всегда подскажут, вовремя принесут и вызовут такси. Отдыхали на летней веранде, свежо и тепло, в общем самое то в жаркую погоду. Сами залы не сильно рассмотрел, но видел что они удобные и просторные.',
        type: 'positive',
        rating: 5
    }
]

const filteredReviews = computed(() => {
    if (activeFilter.value === 'all') return reviews
    if (activeFilter.value === 'positive') return reviews.filter(r => r.rating >= 4)
    if (activeFilter.value === 'negative') return reviews.filter(r => r.rating <= 2)
    if (activeFilter.value === 'new') return reviews.slice(0, 5)
    return reviews
})
</script>

<style scoped>

.reviews-content {
    display: flex;
    gap: 20px;
}
.reviews-page {
    max-width: 100%;
    padding: 25px;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
}

.reviews-list {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.review-yandex {
    background: white;
    border-radius: 8px;
    padding: 3px 5px 3px 3px;
    border: 1px solid #e5e7eb;
    margin-bottom: 10px;
}

.review-card-content {
    background: #f6f8fa;
    padding: 3px;
    border-radius: 10px;
}

.review-card {
    background: white;
    border-radius: 12px;
    padding: 24px;
    box-shadow: 0 8px 8px rgba(0, 0, 0, 0.1);
    border: 1px solid #e5e7eb;
    transition: box-shadow 0.2s ease;
}

.review-card:hover {
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.review-header {
    margin-bottom: 8px;
}

.review-date-branch {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 12px;
}

.left-info {
    display: flex;
    gap: 12px;
    align-items: center;
}

.reviewer-info {
    margin-bottom: 3px;
    display: flex;
    align-items: center;
    gap: 12px;
    flex-wrap: wrap;
}

.text-branch-info {
    font-family: 'Mulish', sans-serif;
    font-weight: 700;
    color: #363740;
    font-size: 12px;
}

.review-card:not(:last-child) {
    border-bottom: 1px solid #f3f4f6;
    padding-bottom: 24px;
}

@media (max-width: 1024px) {
    .reviews-content {
        flex-direction: column-reverse;
    }
}
</style>

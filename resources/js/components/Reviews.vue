<template>
    <div class="reviews-page">
        <button class="review-yandex" @click="openYandex">
            📍 Яндекс Карты
        </button>

        <div v-if="loading" class="status-screen">
            Загрузка...
        </div>
        <div v-else-if="error" class="status-screen">
            Ошибка загрузки данных 😢
        </div>
        <div v-else-if="!companyRating || reviews.length === 0" class="status-screen">
            Нет данных для отображения
        </div>

        <div v-else class="reviews-content">
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
                                    <div class="text-branch-info">{{ companyName }} 📍</div>
                                </div>
                                <RatingStars :value="review.rating" :size="14" />
                            </div>
                        </div>


                        <div class="reviewer-info">
                            <strong class="text-branch-info">{{ review.author }}</strong>
                            <span v-if="review.contact" class="text-branch-info" style="font-size: 10px">
                                <a :href="review.contact" target="_blank" rel="noopener noreferrer">
                                    {{ review.contact }}
                                </a>
                            </span>
                        </div>

                        <div class="text-branch-info" style="font-weight: 400;">{{ review.text }}</div>
                    </div>
                </div>
            </div>
            <Raiting
                :rating="companyRating"
                :count="companyReviewCount"
            />
        </div>
    </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import axios from 'axios'
import Raiting from './Raiting.vue'
import RatingStars from "./RatingStars.vue"

const activeFilter = ref('all')

const loading = ref(true)
const error = ref(false)

const reviews = ref([])
const companyName = ref(null)
const companyRating = ref(null)
const companyReviewCount = ref(null)

const loadData = async () => {
    try {
        loading.value = true
        error.value = false

        const response = await axios.get('/yandex-settings')

        const rawReviews = Array.isArray(response.data.last_reviews)
            ? response.data.last_reviews
            : []

        reviews.value = rawReviews.map(r => ({
            id: r.id,
            author: r.author_name ?? '',
            contact: r.author_contact ?? '',
            date: r.published_at ?? '',
            text: r.description ?? '',
            rating: r.rating,
        }))


        companyName.value = response.data.company_name
        companyRating.value = response.data.company_rating
        companyReviewCount.value = response.data.company_review_count

        loading.value = false
    } catch (err) {
        console.error('Ошибка загрузки данных', err)
        error.value = true
        loading.value = false
    }
}


onMounted(loadData)

const openYandex = () => {
    window.open('https://yandex.ru/maps/', '_blank')
}

const filteredReviews = computed(() => {
    if (activeFilter.value === 'all') return reviews.value
    if (activeFilter.value === 'positive') return reviews.value.filter(r => r.rating >= 4)
    if (activeFilter.value === 'negative') return reviews.value.filter(r => r.rating <= 2)
    if (activeFilter.value === 'new') return reviews.value.slice(0, 5)
    return reviews.value
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

.status-screen {
    width: 100%;
    height: 50vh;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 32px;
    font-weight: 700;
    color: #6C757D;
    text-align: center;
}


@media (max-width: 1024px) {
    .reviews-content {
        flex-direction: column-reverse;
    }
}
</style>

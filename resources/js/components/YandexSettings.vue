<template>
    <div v-if="loading">Загрузка...</div>
    <div v-else-if="error">{{ error }}</div>
    <div v-else>
        <h3>Yandex URL: {{ data.yandex_url }}</h3>
    </div>
</template>

<script>
import { ref, onMounted } from 'vue';
import axios from 'axios';

export default {
    setup() {
        const data = ref(null);
        const loading = ref(true);
        const error = ref(null);

        const fetchData = async () => {
            try {
                const response = await axios.get('/yandex-settings');
                data.value = response.data;
            } catch (err) {
                error.value = err.response?.statusText || 'Ошибка запроса';
                console.error(err);
            } finally {
                loading.value = false;
            }
        };

        onMounted(() => {
            fetchData();
        });

        return { data, loading, error };
    }
};
</script>

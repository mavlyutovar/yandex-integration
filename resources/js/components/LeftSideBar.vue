<template>
    <div class="left-sidebar">
        <div class="main-title-container">
            <img class="logo" src="/images/logo.svg" alt="Logo">
            <h5 class="account-title">{{ accountName }}</h5>
        </div>
        <hr style="margin-bottom: 8px; margin-top: 38px">
        <img src="/images/Menu.svg" alt="Logo" style="width: 249px">
        <nav class="sidebar-nav">
            <ul>
                <li
                    v-for="item in menuItems"
                    :key="item.id"
                    :class="{ active: $route.name === item.route }"
                    @click="navigateTo(item.route)"
                >
                    <span class="icon">{{ item.icon }}</span>
                    <span class="text">{{ item.text }}</span>
                </li>
            </ul>
        </nav>

    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import axios from 'axios'

const router = useRouter()

const accountName = ref('Название Аккаунта')

onMounted(async () => {
    try {
        const response = await axios.get('/user-info')
        accountName.value = response.data.data.name
    } catch (error) {
        console.error('Ошибка загрузки user-info:', error)
    }
})

const menuItems = [
    { id: 'reviews', text: 'Отзывы', icon: '⭐', route: 'Reviews' },
    { id: 'RightContent', text: 'Настройка', icon: '⚙️', route: 'RightContent' },
]

const navigateTo = (routeName) => {
    router.push({ name: routeName })
}
</script>


<style scoped>
.left-sidebar {
    width: 280px;
    height: 100vh;
    background: #f6f8fa;
    color: #363740;
    display: flex;
    flex-direction: column;
    box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
    padding: 16px;
    overflow: visible;
    position: fixed;
}

.sidebar-header h2 {
    margin: 0;
    font-size: 1.4rem;
    font-weight: 600;
}

.sidebar-nav {
    flex: 1;
    padding: 5px 0;
}

.sidebar-nav ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.sidebar-nav li {
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 15px;
    border-left: 4px solid transparent;
}

.sidebar-nav li:hover {
    background: rgba(255,255,255,0.1);
    padding-left: 30px;
}

.sidebar-nav li.active {
    background: #FFFFFF;
    box-shadow: 0px 2px 1px 0px #00000005;
    border-radius: 12px;
}

.sidebar-nav .icon {
    font-size: 1.3rem;
    width: 24px;
    text-align: center;
}

.sidebar-nav .text {
    font-size: 1rem;
    font-weight: 500;
}

.account-title {
    font-family: 'Mulish', sans-serif;
    color: #6c757d;
    font-weight: 700;
}

.logo {
    height: 28px;
    margin: 19px;
}

</style>

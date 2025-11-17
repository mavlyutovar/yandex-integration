<template>
    <div class="header-section">
        <div class="main-title-container">
            <h1 class="main-title"> </h1>
        </div>
        <span  @click="logout" style="cursor: pointer">
            <img class="exit-icon" src="/images/exit.svg" alt="exit">
        </span>
    </div>
</template>

<script setup>
import axios from 'axios'

const logout = async () => {
    try {
        await axios.post('/logout')
        window.location.reload()
    } catch (e) {
        console.error('Logout error:', e)
    }
}
</script>


<style scoped>
.header-section {
  width: 100%;
  display: flex;
  justify-content: space-between;
  text-align: center;
  padding: 16px;
  border-bottom: 1px solid #DCE4EA;
  align-items: center;
}
.main-title {
  font-size: 32px;
  font-weight: 700;
  color: #1a1a1a;
  margin: 0 0 16px 0;
  letter-spacing: -0.5px;
}

.exit-icon {
    height: 44px;
    padding-right: 50px;
}

</style>

<template>
    <main>
        <div id="root">
            <LeftSideBar/>

            <div id="content">
                <Header id="header" />
                <router-view class="router" />
            </div>
        </div>
    </main>
</template>

<script setup>
import LeftSideBar from './components/LeftSideBar.vue'
import Header from './components/Header.vue'
</script>

<style scoped>
* {
    margin: 0;
    padding: 0;
}

#root {
    display: flex;
    height: 100vh;
}

#content {
    margin-left: 280px;
    flex: 1;
    display: flex;
    flex-direction: column;
}

.router {
    flex: 1;
    padding: 20px;
}
</style>

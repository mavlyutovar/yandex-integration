<template>
  <div class="reviews-page">
    <div class="page-header">
      <h2>Подключить Яндекс</h2>
      <div class="content">
        <span class="content-text"> Укажите ссылку на Яндекс, пример
          <a href="https://yandex.ru/maps/org/samoye_populyarnoye_kafe/1010501395/reviews/">
            https://yandex.ru/maps/org/samoye_populyarnoye_kafe/1010501395/reviews/
          </a>
        </span>
        <input class="content-input">
        <button class="content-btn">
          Сохранить
        </button>
      </div>
    </div>

  </div>
</template>


<style scoped>
.reviews-page {
  max-width: 100%;
}

.page-header {
  margin-bottom: 30px;
}

.page-header h1 {
  font-size: 16px;
  font-weight: 600;
  line-height: 20px;
  color: #252733;
  margin-bottom: 15px;
}
.content {
  display: flex;
  flex-direction: column;
  width: 100%;
}
.content-text {
  font-weight: 600;
  font-size: 12px;
  line-height: 20px;
  color: #6C757D;
}
.content-input {
  border: 1px solid #f6f8fa;
  color: transparent;
  border-radius: 6px;
  margin-top: 10px;
}
.content-btn {
  background-color: #339AF0;
  height: 25px;
  border-radius: 6px;
  width: max-content;
  line-height: 17px;
  border: none;
  color: white;
  font-weight: 600;
  font-size: 14px;
  margin-top: 15px;
  padding: 3px 16px 3px 16px ;
}
</style>

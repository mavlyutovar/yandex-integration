<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('yandex_reviews', function (Blueprint $table) {
            $table->id();

            // Связь с настройками (что именно парсим)
            $table->unsignedBigInteger('setting_id')->index();

            // Название точки
            $table->string('company_name')->nullable();

            // Время публикации (точное)
            $table->timestamp('published_at')->nullable();

            // Описание (текст отзыва)
            $table->text('description')->nullable();

            // Имя пользователя (внешний источник)
            $table->string('author_name')->nullable();

            // Номер: может быть email пользователя или номер телефона и т.д.
            $table->string('author_contact')->nullable();

            // Рейтинг (например 4.5 или 5)
            $table->decimal('rating', 3, 1)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('yandex_reviews');
    }
};

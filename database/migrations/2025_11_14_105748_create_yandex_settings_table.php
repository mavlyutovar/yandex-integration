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
        Schema::create('yandex_settings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('yandex_url')->nullable(); // ссылка на карточку
            $table->string('company_name')->nullable(); // Название карточки
            $table->double('company_rating')->nullable(); // Рейтинг карточки
            $table->integer('company_review_count')->nullable(); // Количество отзывов
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
        Schema::dropIfExists('yandex_settings');
    }
};

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

            $table->unsignedBigInteger('setting_id')->index();
            $table->timestamp('published_at')->nullable();
            $table->text('description')->nullable();
            $table->string('author_name')->nullable();
            $table->string('author_contact')->nullable();
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

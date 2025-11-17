<?php

namespace Http;

use Tests\TestCase;

class YandexControllerTest extends TestCase
{

    //php artisan test --filter YandexControllerTest::test_store_yandex_settings
    public function test_store_yandex_settings()
    {
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user, 'web');

        $response = $this->post('/yandex-settings', [
            'yandex_url' => 'https://yandex.ru/maps/org/samoye_populyarnoye_kafe/1010501395/reviews/',
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('yandex_settings', [
            'user_id' => $user->id,
            'yandex_url' => 'https://yandex.ru/maps/org/samoye_populyarnoye_kafe/1010501395/reviews/',
        ]);
        $this->assertDatabaseCount('yandex_settings', 1);
        $this->assertDatabaseCount('yandex_reviews', 50);
    }

    //php artisan test --filter YandexControllerTest::test_get_yandex_settings
    public function test_get_yandex_settings()
    {
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user, 'web');

        $this->post('/yandex-settings', [
            'yandex_url' => 'https://yandex.ru/maps/org/samoye_populyarnoye_kafe/1010501395/reviews/',
        ]);

        $response = $this->get('/yandex-settings');

        $response->assertStatus(200)->assertJsonStructure([
            'yandex_url',
            'company_name',
            'company_rating',
            'company_review_count',
            'reviews' => [
                '*' => [
                    'id',
                    'author_name',
                    'description',
                    'rating',
                    'published_at',
                ]
            ]
        ]);
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class YandexReview extends Model
{
    protected $table = 'yandex_reviews';

    protected $fillable = [
        'setting_id',
        'company_name',
        'published_at',
        'description',
        'author_name',
        'author_contact',
        'rating',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'rating'       => 'decimal:1',
    ];

    /**
     * Связь с настройками Yandex.
     * Каждый отзыв относится к одной настройке.
     */
    public function setting(): BelongsTo
    {
        return $this->belongsTo(YandexSetting::class, 'setting_id', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class YandexSetting extends Model
{
    protected $table = 'yandex_settings';

    protected $fillable = [
        'user_id',
        'yandex_url',
    ];

    /**
     * Связь с отзывами.
     * Один набор настроек → много отзывов.
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(YandexReview::class, 'setting_id', 'id');
    }
}

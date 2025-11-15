<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $user_id
 * @property string $yandex_url
 * @property string $company_name
 * @property double $company_rating
 * @property int $company_review_count
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class YandexSetting extends Model
{
    protected $table = 'yandex_settings';
//
    protected $fillable = [
        'user_id',
        'yandex_url',
        'company_name',
        'company_rating',
        'company_review_count',
    ];

    /**
     * Связь с отзывами.
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(YandexReview::class, 'setting_id', 'id');
    }
}

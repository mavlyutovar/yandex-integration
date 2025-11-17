<?php

namespace App\Repositories;

use App\Data\YandexCompanyInfoData;
use App\Models\YandexReview;
use App\Models\YandexSetting;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class YandexRepository
{

    public function getSettingAndData(int $userId): YandexSetting|\Illuminate\Database\Eloquent\Builder|null
    {
        return YandexSetting::query()
            ->where('user_id', $userId)
            ->with(['lastReviews'])
            ->first();
    }

    public function storeSetting(int $userId, string $url, YandexCompanyInfoData $companyInfoData): YandexSetting|Model|null
    {
        return YandexSetting::query()->updateOrCreate(
            ['user_id' => $userId],
            [
                'yandex_url' => $url,
                'company_name' => $companyInfoData->companyName,
                'company_rating' => $companyInfoData->companyRating,
                'company_review_count' => $companyInfoData->companyReviewCount,
            ]
        );
    }


    public function insertReviews(YandexSetting $yandexSetting, array $reviews): void
    {
        $nowTime = Carbon::now()->toDateTimeString();
        foreach ($reviews as $key => $review) {
            $review['created_at'] = $nowTime;
            $review['updated_at'] = $nowTime;
            $review['setting_id'] = $yandexSetting->id;
            $reviews[$key] = $review;
        }
        YandexReview::query()->insert($reviews);
    }

    public function deleteReviews(YandexSetting $yandexSetting): void
    {
        YandexReview::query()->where('setting_id', $yandexSetting->id)->delete();
    }
}

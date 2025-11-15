<?php

namespace App\Services;

use App\Data\YandexCompanyInfoData;
use App\Models\YandexSetting;
use App\Repositories\YandexRepository;

class YandexService
{
    public function __construct(
        protected YandexRepository $repository
    )
    {
    }
    public function getUrlInfoByUserId(int $userId): YandexSetting|null
    {
        return $this->repository->getSettingAndData($userId);
    }

    public function storeReviews(int $userId, string $url, YandexCompanyInfoData $companyInfo, array $reviews): void
    {
        $yandexSetting = $this->repository->storeSetting($userId, $url, $companyInfo);
        $this->repository->insertReviews($yandexSetting, $reviews);
    }

    public function deleteExistsReviews(int $userId): void
    {
        $yandexSetting = $this->repository->getSettingAndData($userId);
        if (isset($yandexSetting->id)){
            $this->repository->deleteReviews($yandexSetting);
        }
    }
}

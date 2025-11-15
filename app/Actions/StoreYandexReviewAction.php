<?php

namespace App\Actions;


use App\Services\YandexReviewsScraperService;
use App\Services\YandexService;

class StoreYandexReviewAction extends BaseAction
{
    public function __construct(
        protected YandexService $yandexService,
        protected YandexReviewsScraperService $scraperService
    ){
    }

    public function handle(int $userId, string $url): void
    {
        $isValidUrl = $this->scraperService->isValidYandexReviewUrl($url);
        if ($isValidUrl) {
            $htmlContent = $this->scraperService->getHtmlContent($url);
            $reviews = $this->scraperService->fetchReviews($htmlContent);
            $companyInfo = $this->scraperService->getCompanyInfo($htmlContent);
            if (!empty($reviews)) {
                $this->yandexService->deleteExistsReviews($userId);
                $this->yandexService->storeReviews($userId, $url, $companyInfo, $reviews);
            }
        }
    }
}

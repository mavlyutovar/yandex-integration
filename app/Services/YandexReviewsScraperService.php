<?php

namespace App\Services;

use App\Data\YandexCompanyInfoData;
use Carbon\Carbon;
use PHPHtmlParser\Dom;

class YandexReviewsScraperService
{
    /**
     * Получаем отзывы с карточки Яндекс.Карт
     *
     * @param string $url
     * @return array
     */
    public function fetchReviews(string $htmlContent): array
    {
        $dom = new Dom;
        $dom->loadStr($htmlContent);

        $reviews = [];

        // Ищем все отзывы
        foreach ($dom->find('.business-review-view') as $reviewDiv) {
            $review = [];

            // Имя автора
            $authorName = $reviewDiv->find('.business-review-view__author-name span', 0);
            $review['author_name'] = $authorName ? $authorName->text : null;

            // Ссылка на профиль автора
            $authorLink = $reviewDiv->find('.business-review-view__author-name a', 0);
            $review['author_contact'] = $authorLink ? $authorLink->href : null;

            // Дата публикации
            $date = $reviewDiv->find('.business-review-view__date meta', 0);
            $review['published_at'] = $date ? Carbon::parse($date->getAttribute('content'))->toDateTimeString() : null;

            // Текст отзыва
            $desc = $reviewDiv->find('.business-review-view__body .spoiler-view__text-container', 0);
            $review['description'] = $desc ? trim($desc->text) : null;

            // Рейтинг
            $ratingMeta = $reviewDiv->find('span[itemprop=reviewRating] meta[itemprop=ratingValue]', 0);
            $review['rating'] = $ratingMeta ? (float) $ratingMeta->getAttribute('content') : null;

            $reviews[] = $review;
        }

        return $reviews;
    }

    /**
     * Получаем информацию компании
     *
     * @param string $htmlContent
     * @return string|null
     */
    public function getCompanyInfo(string $htmlContent): YandexCompanyInfoData
    {
        $dom = new Dom;
        $dom->loadStr($htmlContent);

        $companyNameMeta = $dom->find('.orgpage-header-view__header', 0);
        $companyName = $companyNameMeta ? $companyNameMeta->text : null;

        $companyRatingMeta = $dom->find('span[itemprop=aggregateRating] meta[itemprop=ratingValue]', 0);
        $companyRating = $companyRatingMeta ? (float) $companyRatingMeta->getAttribute('content') : null;

        $companyReviewCountMeta = $dom->find('span[itemprop=aggregateRating] meta[itemprop=reviewCount]', 0);
        $companyReviewCount = $companyReviewCountMeta ? (int) $companyReviewCountMeta->getAttribute('content') : null;

        return new YandexCompanyInfoData(
            companyName: $companyName,
            companyRating: $companyRating,
            companyReviewCount: $companyReviewCount
        );
    }

    public function getHtmlContent(string $url): string
    {
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $url);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);

        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $htmlContent = curl_exec($curl);

        if ($htmlContent === false) {
            $error = curl_error($curl);
            echo "Ошибка cURL: " . $error;
            exit;
        }

        curl_close($curl);
        return $htmlContent;
    }

    public function isValidYandexReviewUrl(string $url): bool
    {
        // Проверяем, что это URL с yandex и содержит /reviews/
        $pattern = '/^https?:\/\/(www\.)?yandex\.[a-z]{2,3}(\/.*)?\/reviews\//i';
        return preg_match($pattern, $url) === 1;
    }

}

<?php

namespace App\Data;


use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapInputName(SnakeCaseMapper::class)]
#[MapOutputName(SnakeCaseMapper::class)]
class YandexSettingData extends Data
{
    public function __construct(
        public int $id,
        public string $companyName,
        public float $companyRating,
        public int $companyReviewCount,

        #[DataCollectionOf(YandexReviewData::class)]
        public DataCollection $lastReviews
    ) {}
}

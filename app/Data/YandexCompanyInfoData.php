<?php

namespace App\Data;


use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapInputName(SnakeCaseMapper::class)]
#[MapOutputName(SnakeCaseMapper::class)]
class YandexCompanyInfoData extends Data
{
    public function __construct(
        public string $companyName,
        public float $companyRating,
        public int $companyReviewCount,
    ) {}
}

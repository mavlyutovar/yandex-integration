<?php

namespace App\Data;


use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapInputName(SnakeCaseMapper::class)]
#[MapOutputName(SnakeCaseMapper::class)]
class YandexReviewData extends Data
{
    public function __construct(
        public int $id,
        public int $settingId,
        public ?string $authorName,
        public ?string $authorContact,
        public int $rating,
        public ?string $description,
        public string $publishedAt,
    ) {}
}

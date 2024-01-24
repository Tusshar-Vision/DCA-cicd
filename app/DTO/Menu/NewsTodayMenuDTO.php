<?php

namespace App\DTO\Menu;

use App\DTO\NewsTodayDTO;
use Carbon\Carbon;
use Spatie\LaravelData\Data;

class NewsTodayMenuDTO extends Data
{
    public function __construct(
        public string $currentMonth,
        public string $date,
    )
    {}

    public static function fromNewsTodayDTO(NewsTodayDTO $newsTodayDTO): NewsTodayMenuDTO
    {
        return new self (
            Carbon::parse($newsTodayDTO->publishedAt)->format('F Y'),
            Carbon::parse($newsTodayDTO->publishedAt)->format('d'),
        );
    }
}

<?php

namespace App\DTO\Menu;

use App\DTO\NewsTodayDTO;
use Carbon\Carbon;
use Livewire\Wireable;
use Spatie\LaravelData\Concerns\WireableData;
use Spatie\LaravelData\Data;

class NewsTodayMenuDTO extends Data implements Wireable
{
    use WireableData;
    public function __construct(
        public string $currentMonth,
        public string $currentYear,
        public string $date,
        public array $mainMenu
    )
    {}

    public static function fromNewsTodayDTO(NewsTodayDTO $newsTodayDTO, array $mainMenu): NewsTodayMenuDTO
    {
        return new self (
            Carbon::parse($newsTodayDTO->publishedAt)->format('F'),
            Carbon::parse($newsTodayDTO->publishedAt)->format('Y'),
            Carbon::parse($newsTodayDTO->publishedAt)->format('j'),
            $mainMenu
        );
    }
}

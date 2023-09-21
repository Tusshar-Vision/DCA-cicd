<?php

namespace App\Filament\Widgets;

use App\Models\PublishedInitiative;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;

class InitiativesPublishedChart extends ChartWidget
{
    protected static ?string $heading = 'Published Initiatives';
    protected static ?string $pollingInterval = null;

    protected function getData(): array
    {

        // $data = Trend::query(PublishedInitiative::selectRaw('initiative_id, COUNT(*) as count')
        //         ->groupBy('initiative_id'))
        //         ->between(
        //             start: now()->startOfYear(),
        //             end: now()->endOfYear(),
        //         )
        //         ->perMonth()->count();

        // dd($data);

        return [
            //
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}

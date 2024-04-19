<?php

namespace App\Traits\Filament\Components;

use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;

trait PublishedTab
{
    public function getTabs(): array
    {
        return [
            'All' => Tab::make(),
            'Published' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->isPublished()),
        ];
    }

    public function getDefaultActiveTab(): string | int | null
    {
        return 'All';
    }
}

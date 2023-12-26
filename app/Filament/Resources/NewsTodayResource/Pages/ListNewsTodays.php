<?php

namespace App\Filament\Resources\NewsTodayResource\Pages;

use App\Filament\Resources\NewsTodayResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListNewsTodays extends ListRecords
{
    protected static string $resource = NewsTodayResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

//    public function getTabs(): array
//    {
//        return [
//            'all' => Tab::make('Articles'),
//            'active' => Tab::make('Reviewers')
//                ->modifyQueryUsing(fn (Builder $query) => dd($query)),
//            'inactive' => Tab::make('Experts')
//                ->modifyQueryUsing(fn (Builder $query) => $query->where('active', false)),
//        ];
//    }
}

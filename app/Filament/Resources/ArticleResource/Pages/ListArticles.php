<?php

namespace App\Filament\Resources\ArticleResource\Pages;

use App\Filament\Resources\ArticleResource;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Pboivin\FilamentPeek\Pages\Concerns\HasPreviewModal;

class ListArticles extends ListRecords
{
    protected static string $resource = ArticleResource::class;

    public function getTabs(): array
    {
        return [
            'All' => Tab::make(),
            'In Progress' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->currentStatus(['Draft', 'Improve', 'Changes Incorporated'])),
            'Final' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->currentStatus('Final')),
            'Published' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->currentStatus('Published')),
            'Rejected' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->currentStatus('Reject')),
        ];
    }

    public function getDefaultActiveTab(): string | int | null
    {
        return 'All';
    }
    protected function getHeaderActions(): array
    {
        return [
//            Actions\CreateAction::make(),
        ];
    }
}

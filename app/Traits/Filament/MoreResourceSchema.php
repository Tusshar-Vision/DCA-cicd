<?php

namespace App\Traits\Filament;

use App\Models\PublishedInitiative;
use Carbon\Carbon;
use Filament\Support\Colors\Color;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ForceDeleteBulkAction;
use Filament\Tables\Actions\RestoreBulkAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

trait MoreResourceSchema
{
    use HelperMethods;
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),

                TextColumn::make('name'),

                TextColumn::make('topic.name')->label('Subject'),

                IconColumn::make('is_published')
                    ->alignCenter()
                    ->label('Is Published'),

                TextColumn::make('published_at')
                    ->dateTime('d M Y')
                    ->label('Publish On')
                    ->sortable(),
            ])
            ->defaultSort('published_at', 'desc')
            ->filters([
                TrashedFilter::make(),
            ])
            ->actions([
                Action::make('Publish')
                    ->icon('heroicon-s-paper-airplane')
                    ->requiresConfirmation()
                    ->button()
                    ->visible(function () {
                        return \Auth::user()->hasAnyRole(['super_admin', 'admin']);
                    })
                    ->hidden(function(PublishedInitiative $record) {
                        return $record->is_published;
                    })
                    ->action(function (PublishedInitiative $record) {
                        if ($record->is_published === false) {
                            $record->is_published = true;
                            $record->save();
                        }
                    }),
                Action::make('View')
                    ->icon('heroicon-s-eye')
                    ->tooltip('View')
                    ->iconButton()
                    ->url(fn (PublishedInitiative $record): string|null => $record->getFirstMedia(static::getCollectionName())?->getTemporaryUrl(now()->add('minutes', 120)))
                    ->openUrlInNewTab(),
                EditAction::make()
                    ->tooltip('Edit')
                    ->iconButton(),
                DeleteAction::make()
                    ->tooltip('Delete')
                    ->iconButton()
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    BulkAction::make('Unpublish')
                        ->icon('heroicon-s-x-mark')
                        ->color(Color::Yellow)
                        ->requiresConfirmation()
                        ->modalDescription('This action would unpublish all the selected files')
                        ->visible(function () {
                            return \Auth::user()->hasAnyRole(['super_admin', 'admin']);
                        })
                        ->action(function (?Collection $records) {
                            $records->each(function ($record) {
                                $record->is_published = false;
                                $record->save();
                            });
                        })
                        ->deselectRecordsAfterCompletion(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}

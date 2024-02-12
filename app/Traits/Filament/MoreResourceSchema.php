<?php

namespace App\Traits\Filament;

use App\Models\PublishedInitiative;
use Carbon\Carbon;
use Filament\Support\Colors\Color;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
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
    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),

                TextColumn::make('name'),

                IconColumn::make('is_published')
                    ->alignCenter()
                    ->label('Is Published'),

                TextColumn::make('published_at')
                    ->dateTime('d M Y')
                    ->label('Publish On')
                    ->sortable(),

            ])->defaultSort('published_at', 'desc')
            ->filters([
                TrashedFilter::make(),
            ])
            ->actions([
                Action::make('Publish')
                    ->icon('heroicon-s-eye')
                    ->requiresConfirmation()
                    ->button()
                    ->hidden(function(PublishedInitiative $record) {
                        return $record->is_published;
                    })
                    ->action(function (PublishedInitiative $record) {
                        if ($record->is_published === false) {
                            $record->is_published = true;
                            $record->save();
                        }
                    }),
                EditAction::make()
                    ->tooltip('Edit')
                    ->iconButton(),
                DeleteAction::make()
                    ->tooltip('Delete')
                    ->hidden(function(PublishedInitiative $record) {
                        return $record->is_published;
                    })
                    ->iconButton()
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    BulkAction::make('Unpublish')
                        ->icon('heroicon-s-x-mark')
                        ->color(Color::Yellow)
                        ->requiresConfirmation()
                        ->modalDescription('This action would unpublish all the selected files')
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

    private static function generateName(string $date): array|string
    {
        return str_replace(
            ' ',
            '_',
            static::$modelLabel . ' ' . Carbon::parse($date)
                ->format('Y-m-d')
        );
    }
}

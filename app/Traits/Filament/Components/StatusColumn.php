<?php

namespace App\Traits\Filament\Components;

use Filament\Support\Colors\Color;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;

trait StatusColumn
{
    public function getStatusColumn(bool $canChangeStatus)
    {
        if ($canChangeStatus === false) {
            return TextColumn::make('article.status')
                ->label('Status')
                ->default(function (Model $record) {
                    return mb_substr($record->status, 0, 1);
                })
                ->tooltip(function (Model $record) {
                    return $record->status;
                })
                ->badge()
                ->alignCenter()
                ->color(function (Model $record) {
                    switch ($record->status) {
                        case 'Draft': return Color::Gray;
                        case 'Improve': return Color::Yellow;
                        case 'Changes Incorporated': return Color::Blue;
                        case 'Reject': return Color::Red;
                        case 'Final': return Color::Orange;
                        case 'Published': return Color::Green;
                        case 'Final Database': return Color::Indigo;
                    }
                })->toggleable();
        }

        return SelectColumn::make('status')
            ->label('Current Assigned Status')
            ->options([
                "Draft" => "Draft",
                "Improve" => "Improve",
                "Changes Incorporated" => "Changes Incorporated",
                "Reject" => "Reject",
                "Final" => "Final",
                "Published" => "Published"
            ])
            ->disabled(function (Model $record) {
                return $record->status === 'Published';
            })
            ->selectablePlaceholder(false)
            ->default(function (Model $record) {
                return $record->status;
            })
            ->updateStateUsing(function ($record, $state) {
                $record->setStatus($state);
            })
            ->disableOptionWhen(fn (string $value): bool => $value === 'Changes Incorporated' || $value === 'Draft' || $value === 'Published')
            ->toggleable();
    }
}

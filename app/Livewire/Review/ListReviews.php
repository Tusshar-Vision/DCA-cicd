<?php

namespace App\Livewire\Review;

use Digikraaft\ReviewRating\Models\Review;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;
use Illuminate\Contracts\View\View;

class ListReviews extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public ?Model $record;

    public function table(Table $table): Table
    {
        return $table
            ->paginated(false)
            ->query(Review::query()->where('model_id', '=', $this->record->id))
            ->columns([
                TextColumn::make('title')->label('Subject'),
                TextColumn::make('review')->html(),
                TextColumn::make('author.name')->label('Reviewer')
            ])
            ->filters([
                //
            ])
            ->actions([
                //
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    //
                ]),
            ]);
    }

    public function render(): View
    {
        return view('livewire.review.list-reviews');
    }
}

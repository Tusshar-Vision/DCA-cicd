<?php

namespace App\Livewire\Review;

use Digikraaft\ReviewRating\Models\Review;
use Filament\Forms;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;
use Illuminate\Contracts\View\View;

class CreateReview extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public ?Model $record;

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('status')->options([
                    "Draft" => "Draft",

                    'In Process' => [
                        "Improve" => "Improve",
                        "Changes Incorporated" => "Changes Incorporated",
                    ],
                    'Reviewed' => [
                        "Reject" => "Reject",
                        "Final" => "Final",
                    ]
                ])->default(function() {
                    return $this->record->status;
                })->required()
                ->disableOptionWhen(fn (string $value): bool => $value === 'Changes Incorporated' || $value === 'Draft')
                ->disabled(function () {
                    $user = \Auth::user();

                    if($user->hasRole(['admin', 'super_admin'])) return false;

                    return $user->can('review_article') && $record->reviewer_id == $user->id;
                }),
                RichEditor::make('body')
                    ->required()
                    ->default(function() {
                        return $this->record->latestReview()->review ?? '';
                    })
                    ->disabled(function () {
                        $user = \Auth::user();

                        return !$user->hasRole(['reviewer', 'admin', 'super_admin']);
                    })
                    ->label(''),
            ])
            ->statePath('data')
            ->model(Review::class);
    }

    public function create(): void
    {
        $data = $this->form->getState();
        $author = \Auth::user();

        if($this->record->hasReview())
            $this->record->latestReview()->update(['review' => $data['body']]);
        else
            $this->review($data['body'], $author, 0);

        $this->record->setStatus($data['status']);
    }

    public function render(): View
    {
        return view('livewire.review.create-review');
    }
}
